// Package server wires the dependencies and exposes the click2call HTTP(S) API:
//
//	POST /challenge { aor }                               -> { nonce, realm }
//	POST /call      { aor, nonce, response, destination,  -> { iden }
//	                  iden?, maxDuration?, dialTimeout?, optimize? }
package server

import (
	"crypto/rand"
	"encoding/json"
	"fmt"
	"net/http"
	"regexp"
	"strings"

	logger "github.com/sirupsen/logrus"

	"irontec.com/click2call/pkg/ami"
	"irontec.com/click2call/pkg/config"
	"irontec.com/click2call/pkg/db"
	"irontec.com/click2call/pkg/digest"
	"irontec.com/click2call/pkg/kamailio"
)

const (
	dialUserContext   = "click2dial-user"
	dialTargetContext = "click2dial-target"
)

var (
	destinationRe = regexp.MustCompile(`^[+*0-9]+$`)
	idenRe        = regexp.MustCompile(`^[A-Za-z0-9_-]{1,32}$`)
	idenAlphabet  = "0123456789ABCDEFGHIJKLMNOPQRSTUVWXYZabcdefghijklmnopqrstuvwxyz"
)

// Handler holds the service dependencies shared by the HTTP handlers.
type Handler struct {
	digest         *digest.Manager
	db             *db.DB
	kam            *kamailio.Client
	ami            *ami.Client
	allowedOrigins []string

	defaultDialTimeout int
	defaultMaxDuration int
	defaultOptimize    bool
}

// Run builds the dependencies from config and starts the server (blocking).
func Run() error {
	database, err := db.New(
		config.GetDBHost(), config.GetDBPort(),
		config.GetDBUser(), config.GetDBPassword(), config.GetDBName(),
	)
	if err != nil {
		return fmt.Errorf("db init: %w", err)
	}

	h := &Handler{
		digest:             digest.NewManager(config.GetDigestSecret(), config.GetNonceTTL()),
		db:                 database,
		kam:                kamailio.New(config.GetKamailioRPCURL()),
		ami:                ami.New(config.GetAMIUser(), config.GetAMISecret(), config.GetAMIPort()),
		allowedOrigins:     config.GetAllowedOrigins(),
		defaultDialTimeout: config.GetDialTimeout(),
		defaultMaxDuration: config.GetMaxDuration(),
		defaultOptimize:    config.GetOptimize(),
	}

	mux := http.NewServeMux()
	mux.HandleFunc("/challenge", h.withCORS(h.challenge))
	mux.HandleFunc("/call", h.withCORS(h.call))

	addr := config.GetListenAddress()
	srv := &http.Server{Addr: addr, Handler: mux}

	cert, key := config.GetTLSCert(), config.GetTLSKey()
	if cert != "" && key != "" {
		logger.Infof("click2call listening (https) on %s", addr)
		return srv.ListenAndServeTLS(cert, key)
	}
	logger.Infof("click2call listening (http) on %s", addr)
	return srv.ListenAndServe()
}

// -------------------------------------------------------------------------- //
//  /challenge                                                                 //
// -------------------------------------------------------------------------- //

type challengeRequest struct {
	AoR string `json:"aor"`
}

type challengeResponse struct {
	Nonce string `json:"nonce"`
	Realm string `json:"realm"`
}

func (h *Handler) challenge(w http.ResponseWriter, r *http.Request) {
	if r.Method != http.MethodPost {
		writeError(w, http.StatusMethodNotAllowed, "method not allowed")
		return
	}

	var req challengeRequest
	if err := json.NewDecoder(r.Body).Decode(&req); err != nil {
		writeError(w, http.StatusBadRequest, "invalid json body")
		return
	}

	_, domain, ok := splitAoR(req.AoR)
	if !ok {
		writeError(w, http.StatusBadRequest, "invalid aor")
		return
	}

	// realm = domain part of the AoR. No database access here.
	nonce, err := h.digest.NewNonce(req.AoR)
	if err != nil {
		logger.Errorf("nonce generation: %v", err)
		writeError(w, http.StatusInternalServerError, "internal error")
		return
	}

	writeJSON(w, http.StatusOK, challengeResponse{Nonce: nonce, Realm: domain})
}

// -------------------------------------------------------------------------- //
//  /call                                                                      //
// -------------------------------------------------------------------------- //

type callRequest struct {
	AoR         string `json:"aor"`
	Nonce       string `json:"nonce"`
	Response    string `json:"response"`
	Destination string `json:"destination"`
	Iden        string `json:"iden"`
	MaxDuration *int   `json:"maxDuration"`
	DialTimeout *int   `json:"dialTimeout"`
	Optimize    *bool  `json:"optimize"`
}

type callResponse struct {
	Iden string `json:"iden"`
}

func (h *Handler) call(w http.ResponseWriter, r *http.Request) {
	if r.Method != http.MethodPost {
		writeError(w, http.StatusMethodNotAllowed, "method not allowed")
		return
	}

	var req callRequest
	if err := json.NewDecoder(r.Body).Decode(&req); err != nil {
		writeError(w, http.StatusBadRequest, "invalid json body")
		return
	}

	username, domain, ok := splitAoR(req.AoR)
	if !ok {
		writeError(w, http.StatusBadRequest, "invalid aor")
		return
	}
	if !destinationRe.MatchString(req.Destination) {
		writeError(w, http.StatusBadRequest, "invalid destination")
		return
	}

	iden := req.Iden
	if iden == "" {
		iden = generateIden()
	} else if !idenRe.MatchString(iden) {
		writeError(w, http.StatusBadRequest, "invalid iden")
		return
	}

	// 1) Nonce (signature + freshness + single-use). Consumed on success.
	if err := h.digest.ValidateNonce(req.AoR, req.Nonce); err != nil {
		writeError(w, http.StatusUnauthorized, "invalid nonce")
		return
	}

	// 2) Credentials for the AoR (also the eligibility gate).
	creds, err := h.db.GetCredentials(domain, username)
	if err == db.ErrNotEligible {
		writeError(w, http.StatusForbidden, "forbidden")
		return
	}
	if err != nil {
		logger.Errorf("db credentials: %v", err)
		writeError(w, http.StatusBadGateway, "backend error")
		return
	}

	// 3) Digest verification (realm = domain), constant-time.
	if !digest.Verify(req.Response, username, domain, creds.Password, req.Nonce, req.Destination) {
		writeError(w, http.StatusForbidden, "forbidden")
		return
	}

	// 4) Which ApplicationServer handles this company.
	asHost, err := h.kam.ResolveAS(creds.CompanyID)
	if err != nil {
		logger.Errorf("resolve AS for company %d: %v", creds.CompanyID, err)
		writeError(w, http.StatusBadGateway, "could not resolve application server")
		return
	}

	// 5) Originate.
	if err := h.ami.Originate(asHost, h.buildOriginate(req, creds, iden)); err != nil {
		logger.Errorf("originate on %s: %v", asHost, err)
		writeError(w, http.StatusBadGateway, "could not originate call")
		return
	}

	logger.Infof("click2call originated: aor=%s dst=%s as=%s iden=%s",
		req.AoR, req.Destination, asHost, iden)
	writeJSON(w, http.StatusOK, callResponse{Iden: iden})
}

func (h *Handler) buildOriginate(req callRequest, creds *db.Credentials, iden string) ami.OriginateParams {
	dialTimeout := h.defaultDialTimeout
	if req.DialTimeout != nil && *req.DialTimeout > 0 {
		dialTimeout = *req.DialTimeout
	}
	maxDuration := h.defaultMaxDuration
	if req.MaxDuration != nil && *req.MaxDuration > 0 {
		maxDuration = *req.MaxDuration
	}
	optimize := h.defaultOptimize
	if req.Optimize != nil {
		optimize = *req.Optimize
	}

	channel := "Local/" + req.Destination + "@" + dialUserContext
	if !optimize {
		channel += "/n"
	}

	return ami.OriginateParams{
		Channel:        channel,
		Exten:          req.Destination,
		Context:        dialTargetContext,
		Priority:       1,
		CallerID:       creds.Extension,
		TimeoutMs:      dialTimeout * 1000,
		ChannelID:      iden,
		OtherChannelID: iden + "-2",
		Variables: map[string]string{
			"C2DENDPOINT":     creds.SorceryID,
			"ORIGINATE_EXTEN": creds.Extension,
			// __ prefix => inheritable: needed so click2dial-user-headers (run on
			// the dialed PJSIP channel) can fill X-Info-BrandId/CompanyId.
			"__BRANDID":     fmt.Sprintf("%d", creds.BrandID),
			"__COMPANYID":   fmt.Sprintf("%d", creds.CompanyID),
			"DIAL_TIMEOUT":  fmt.Sprintf("%d", dialTimeout),
			"MAX_DURATION":  fmt.Sprintf("%d", maxDuration),
			"DIAL_DEF_OPTS": "",
			"DIAL_OPTS":     "",
		},
	}
}

// -------------------------------------------------------------------------- //
//  Helpers                                                                    //
// -------------------------------------------------------------------------- //

// splitAoR splits "username@domain" and rejects empty/invalid parts.
func splitAoR(aor string) (username, domain string, ok bool) {
	at := strings.LastIndexByte(aor, '@')
	if at <= 0 || at == len(aor)-1 {
		return "", "", false
	}
	username = aor[:at]
	domain = aor[at+1:]
	if strings.ContainsAny(username, " \r\n") || strings.ContainsAny(domain, " \r\n") {
		return "", "", false
	}
	return username, domain, true
}

// generateIden returns a 16-char base62 identifier (~95 bits).
func generateIden() string {
	buf := make([]byte, 16)
	if _, err := rand.Read(buf); err != nil {
		// rand.Read failing is fatal-ish; fall back to a fixed-length marker.
		return strings.Repeat("0", 16)
	}
	out := make([]byte, 16)
	for i, b := range buf {
		out[i] = idenAlphabet[int(b)%len(idenAlphabet)]
	}
	return string(out)
}

func (h *Handler) withCORS(next http.HandlerFunc) http.HandlerFunc {
	return func(w http.ResponseWriter, r *http.Request) {
		h.setCORS(w, r)
		if r.Method == http.MethodOptions {
			w.WriteHeader(http.StatusNoContent)
			return
		}
		next(w, r)
	}
}

func (h *Handler) setCORS(w http.ResponseWriter, r *http.Request) {
	origin := r.Header.Get("Origin")
	allow := ""
	for _, o := range h.allowedOrigins {
		if o == "*" {
			allow = "*"
			break
		}
		if o == origin {
			allow = origin
			break
		}
	}
	if allow == "" {
		return
	}
	w.Header().Set("Access-Control-Allow-Origin", allow)
	w.Header().Set("Access-Control-Allow-Methods", "POST, OPTIONS")
	w.Header().Set("Access-Control-Allow-Headers", "Content-Type")
}

func writeJSON(w http.ResponseWriter, status int, body any) {
	w.Header().Set("Content-Type", "application/json")
	w.WriteHeader(status)
	_ = json.NewEncoder(w).Encode(body)
}

func writeError(w http.ResponseWriter, status int, message string) {
	writeJSON(w, status, map[string]string{"error": message})
}

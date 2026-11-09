package server

import (
	"bytes"
	"encoding/json"
	"errors"
	"net/http"
	"net/http/httptest"
	"reflect"
	"strings"
	"testing"

	logger "github.com/sirupsen/logrus"
	logtest "github.com/sirupsen/logrus/hooks/test"

	"irontec.com/click2call/pkg/ami"
	"irontec.com/click2call/pkg/db"
	"irontec.com/click2call/pkg/digest"
)

const (
	testAoR      = "101@example.com"
	testUser     = "101"
	testDomain   = "example.com"
	testPassword = "s3cr3t-terminal-pass"
	testDst      = "600123123"
	testIP       = "203.0.113.7"
)

// ------------------------------------------------------------------------ //
//  Fakes                                                                    //
// ------------------------------------------------------------------------ //

type fakeStore struct {
	creds *db.Credentials
	err   error

	gotDomain, gotUser string
}

func (f *fakeStore) GetCredentials(domain, username string) (*db.Credentials, error) {
	f.gotDomain, f.gotUser = domain, username
	return f.creds, f.err
}

type fakeResolver struct {
	host string
	err  error

	gotCompanyID int
}

func (f *fakeResolver) ResolveAS(companyID int) (string, error) {
	f.gotCompanyID = companyID
	return f.host, f.err
}

type fakeOriginator struct {
	err error

	calls   int
	gotHost string
	gotP    ami.OriginateParams
}

func (f *fakeOriginator) Originate(host string, p ami.OriginateParams) error {
	f.calls++
	f.gotHost, f.gotP = host, p
	return f.err
}

type fixture struct {
	h     *Handler
	store *fakeStore
	kam   *fakeResolver
	ami   *fakeOriginator
	logs  *logtest.Hook
}

func newFixture(t *testing.T) *fixture {
	t.Helper()

	hook := logtest.NewGlobal()
	prevLevel := logger.GetLevel()
	logger.SetLevel(logger.InfoLevel)
	t.Cleanup(func() {
		hook.Reset()
		logger.StandardLogger().ReplaceHooks(make(logger.LevelHooks))
		logger.SetLevel(prevLevel)
	})

	f := &fixture{
		store: &fakeStore{creds: &db.Credentials{
			BrandID:   3,
			CompanyID: 7,
			Password:  testPassword,
			SorceryID: "b3c7t12_101",
			Extension: "101",
		}},
		kam:  &fakeResolver{host: "10.0.0.5"},
		ami:  &fakeOriginator{},
		logs: hook,
	}
	f.h = &Handler{
		digest:             digest.NewManager("test-secret", 30),
		db:                 f.store,
		kam:                f.kam,
		ami:                f.ami,
		allowedOrigins:     []string{"https://allowed.example"},
		defaultDialTimeout: 30,
		defaultMaxDuration: 3600,
		defaultOptimize:    true,
	}
	return f
}

func (f *fixture) nonce(t *testing.T, aor string) string {
	t.Helper()
	n, err := f.h.digest.NewNonce(aor)
	if err != nil {
		t.Fatalf("NewNonce: %v", err)
	}
	return n
}

// validCall returns a correctly signed /call body for testAoR -> testDst.
func (f *fixture) validCall(t *testing.T) map[string]any {
	t.Helper()
	nonce := f.nonce(t, testAoR)
	return map[string]any{
		"aor":         testAoR,
		"nonce":       nonce,
		"response":    digest.Response(testUser, testDomain, testPassword, nonce, testDst),
		"destination": testDst,
	}
}

func do(handler http.HandlerFunc, method string, body any) *httptest.ResponseRecorder {
	var buf bytes.Buffer
	switch b := body.(type) {
	case nil:
	case string:
		buf.WriteString(b)
	default:
		_ = json.NewEncoder(&buf).Encode(b)
	}
	req := httptest.NewRequest(method, "/", &buf)
	req.RemoteAddr = testIP + ":54321"
	rec := httptest.NewRecorder()
	handler(rec, req)
	return rec
}

func decode(t *testing.T, rec *httptest.ResponseRecorder) map[string]string {
	t.Helper()
	var out map[string]string
	if err := json.Unmarshal(rec.Body.Bytes(), &out); err != nil {
		t.Fatalf("decode body %q: %v", rec.Body.String(), err)
	}
	return out
}

func assertStatus(t *testing.T, rec *httptest.ResponseRecorder, want int) {
	t.Helper()
	if rec.Code != want {
		t.Fatalf("status = %d, want %d (body %q)", rec.Code, want, rec.Body.String())
	}
}

// ------------------------------------------------------------------------ //
//  Authentication failure logging                                           //
// ------------------------------------------------------------------------ //

func TestCallAuthFailuresAreLogged(t *testing.T) {
	cases := []struct {
		name       string
		prepare    func(t *testing.T, f *fixture) map[string]any
		wantStatus int
		wantReason string
	}{
		{
			name: "invalid nonce",
			prepare: func(t *testing.T, f *fixture) map[string]any {
				body := f.validCall(t)
				body["nonce"] = "1.deadbeef.forged"
				return body
			},
			wantStatus: http.StatusUnauthorized,
			wantReason: "invalid_nonce",
		},
		{
			name: "not eligible",
			prepare: func(t *testing.T, f *fixture) map[string]any {
				f.store.creds, f.store.err = nil, db.ErrNotEligible
				return f.validCall(t)
			},
			wantStatus: http.StatusForbidden,
			wantReason: "not_eligible",
		},
		{
			name: "bad response",
			prepare: func(t *testing.T, f *fixture) map[string]any {
				body := f.validCall(t)
				body["response"] = digest.Response(testUser, testDomain, "wrong", body["nonce"].(string), testDst)
				return body
			},
			wantStatus: http.StatusForbidden,
			wantReason: "bad_response",
		},
	}

	for _, tc := range cases {
		t.Run(tc.name, func(t *testing.T) {
			f := newFixture(t)
			body := tc.prepare(t, f)

			rec := do(f.h.call, http.MethodPost, body)
			assertStatus(t, rec, tc.wantStatus)

			var failures []*logger.Entry
			for _, e := range f.logs.AllEntries() {
				if e.Message == "click2call auth failed" {
					failures = append(failures, e)
				}
			}
			if len(failures) != 1 {
				t.Fatalf("got %d auth failure entries, want 1", len(failures))
			}
			e := failures[0]
			if e.Level != logger.WarnLevel {
				t.Errorf("level = %s, want warning", e.Level)
			}
			want := logger.Fields{
				"status": tc.wantStatus,
				"reason": tc.wantReason,
				"aor":    testAoR,
				"dst":    testDst,
				"ip":     testIP,
			}
			if len(e.Data) != len(want) {
				t.Errorf("fields = %v, want exactly %v", e.Data, want)
			}
			for k, v := range want {
				if e.Data[k] != v {
					t.Errorf("field %s = %v, want %v", k, e.Data[k], v)
				}
			}

			assertNoSecretsLogged(t, f.logs, body["nonce"].(string), body["response"].(string))
		})
	}
}

func TestCallSuccessLogsIPWithoutSecrets(t *testing.T) {
	f := newFixture(t)
	body := f.validCall(t)
	body["iden"] = "client-iden-1"

	rec := do(f.h.call, http.MethodPost, body)
	assertStatus(t, rec, http.StatusOK)

	var found bool
	for _, e := range f.logs.AllEntries() {
		if strings.HasPrefix(e.Message, "click2call originated") {
			found = true
			if e.Data["ip"] != testIP {
				t.Errorf("ip = %v, want %s", e.Data["ip"], testIP)
			}
		}
	}
	if !found {
		t.Fatal("no success log entry")
	}
	assertNoSecretsLogged(t, f.logs, body["nonce"].(string), body["response"].(string), "client-iden-1")
}

// assertNoSecretsLogged fails if any log entry carries the terminal password or
// any of the given values (nonce, response, iden), in its message or fields.
func assertNoSecretsLogged(t *testing.T, hook *logtest.Hook, values ...string) {
	t.Helper()
	secrets := append([]string{testPassword}, values...)
	for _, e := range hook.AllEntries() {
		line, err := e.String()
		if err != nil {
			t.Fatalf("format entry: %v", err)
		}
		for _, s := range secrets {
			if strings.Contains(line, s) {
				t.Errorf("log entry %q leaks %q", line, s)
			}
		}
	}
}

func TestClientIP(t *testing.T) {
	cases := map[string]string{
		"203.0.113.7:54321":     "203.0.113.7",
		"[2001:db8::1]:443":     "2001:db8::1",
		"203.0.113.7":           "203.0.113.7",
		"not-a-host-port-value": "not-a-host-port-value",
	}
	for remote, want := range cases {
		req := httptest.NewRequest(http.MethodPost, "/", nil)
		req.RemoteAddr = remote
		if got := clientIP(req); got != want {
			t.Errorf("clientIP(%q) = %q, want %q", remote, got, want)
		}
	}
}

var errBoom = errors.New("boom")

// ------------------------------------------------------------------------ //
//  /challenge                                                               //
// ------------------------------------------------------------------------ //

func TestChallengeRejectsNonPost(t *testing.T) {
	f := newFixture(t)
	assertStatus(t, do(f.h.challenge, http.MethodGet, nil), http.StatusMethodNotAllowed)
}

func TestChallengeRejectsInvalidJSON(t *testing.T) {
	f := newFixture(t)
	assertStatus(t, do(f.h.challenge, http.MethodPost, "{not json"), http.StatusBadRequest)
}

func TestChallengeRejectsInvalidAoR(t *testing.T) {
	for _, aor := range []string{"", "sinarroba", "@dominio", "usuario@", "us uario@example.com", "101@exa mple.com", "101@example.com\n"} {
		f := newFixture(t)
		rec := do(f.h.challenge, http.MethodPost, map[string]string{"aor": aor})
		assertStatus(t, rec, http.StatusBadRequest)
		if got := decode(t, rec)["error"]; got != "invalid aor" {
			t.Errorf("aor %q: error = %q", aor, got)
		}
	}
}

func TestChallengeReturnsNonceAndRealm(t *testing.T) {
	f := newFixture(t)
	rec := do(f.h.challenge, http.MethodPost, map[string]string{"aor": testAoR})
	assertStatus(t, rec, http.StatusOK)

	out := decode(t, rec)
	if out["nonce"] == "" {
		t.Error("empty nonce")
	}
	if out["realm"] != testDomain {
		t.Errorf("realm = %q, want %q", out["realm"], testDomain)
	}
	if err := f.h.digest.ValidateNonce(testAoR, out["nonce"]); err != nil {
		t.Errorf("issued nonce does not validate for its AoR: %v", err)
	}
}

// ------------------------------------------------------------------------ //
//  /call                                                                    //
// ------------------------------------------------------------------------ //

func TestCallRejectsNonPost(t *testing.T) {
	f := newFixture(t)
	assertStatus(t, do(f.h.call, http.MethodGet, nil), http.StatusMethodNotAllowed)
}

func TestCallBadRequests(t *testing.T) {
	cases := []struct {
		name    string
		mutate  func(body map[string]any) any
		wantErr string
	}{
		{"invalid json", func(map[string]any) any { return "{not json" }, "invalid json body"},
		{"invalid aor", func(b map[string]any) any { b["aor"] = "sinarroba"; return b }, "invalid aor"},
		{"invalid destination", func(b map[string]any) any { b["destination"] = "60a"; return b }, "invalid destination"},
		{"empty destination", func(b map[string]any) any { b["destination"] = ""; return b }, "invalid destination"},
		{"iden too long", func(b map[string]any) any { b["iden"] = strings.Repeat("a", 33); return b }, "invalid iden"},
		{"iden bad chars", func(b map[string]any) any { b["iden"] = "abc def"; return b }, "invalid iden"},
	}
	for _, tc := range cases {
		t.Run(tc.name, func(t *testing.T) {
			f := newFixture(t)
			rec := do(f.h.call, http.MethodPost, tc.mutate(f.validCall(t)))
			assertStatus(t, rec, http.StatusBadRequest)
			if got := decode(t, rec)["error"]; got != tc.wantErr {
				t.Errorf("error = %q, want %q", got, tc.wantErr)
			}
			if f.ami.calls != 0 {
				t.Error("originated on a bad request")
			}
			if len(f.logs.AllEntries()) != 0 {
				t.Errorf("400 must not be logged, got %d entries", len(f.logs.AllEntries()))
			}
		})
	}
}

func TestCallRejectsNonceForAnotherAoR(t *testing.T) {
	f := newFixture(t)
	body := f.validCall(t)
	nonce := f.nonce(t, "202@example.com")
	body["nonce"] = nonce
	body["response"] = digest.Response(testUser, testDomain, testPassword, nonce, testDst)

	assertStatus(t, do(f.h.call, http.MethodPost, body), http.StatusUnauthorized)
}

func TestCallRejectsReusedNonce(t *testing.T) {
	f := newFixture(t)
	body := f.validCall(t)

	assertStatus(t, do(f.h.call, http.MethodPost, body), http.StatusOK)
	rec := do(f.h.call, http.MethodPost, body)
	assertStatus(t, rec, http.StatusUnauthorized)
	if got := decode(t, rec)["error"]; got != "invalid nonce" {
		t.Errorf("error = %q", got)
	}
	if f.ami.calls != 1 {
		t.Errorf("originate calls = %d, want 1", f.ami.calls)
	}
}

func TestCallForbiddenDoesNotDistinguishCauses(t *testing.T) {
	notEligible := newFixture(t)
	notEligible.store.creds, notEligible.store.err = nil, db.ErrNotEligible
	recA := do(notEligible.h.call, http.MethodPost, notEligible.validCall(t))

	badResponse := newFixture(t)
	body := badResponse.validCall(t)
	body["response"] = strings.Repeat("0", 32)
	recB := do(badResponse.h.call, http.MethodPost, body)

	assertStatus(t, recA, http.StatusForbidden)
	assertStatus(t, recB, http.StatusForbidden)
	if recA.Body.String() != recB.Body.String() {
		t.Errorf("403 bodies differ: %q vs %q", recA.Body.String(), recB.Body.String())
	}
	if notEligible.ami.calls+badResponse.ami.calls != 0 {
		t.Error("originated on a forbidden request")
	}
}

func TestCallAcceptsUppercaseResponse(t *testing.T) {
	f := newFixture(t)
	body := f.validCall(t)
	body["response"] = strings.ToUpper(body["response"].(string))
	assertStatus(t, do(f.h.call, http.MethodPost, body), http.StatusOK)
}

func TestCallBackendErrors(t *testing.T) {
	cases := []struct {
		name    string
		prepare func(f *fixture)
		wantErr string
	}{
		{"credentials error", func(f *fixture) { f.store.creds, f.store.err = nil, errBoom }, "backend error"},
		{"resolve AS error", func(f *fixture) { f.kam.err = errBoom }, "could not resolve application server"},
		{"originate error", func(f *fixture) { f.ami.err = errBoom }, "could not originate call"},
	}
	for _, tc := range cases {
		t.Run(tc.name, func(t *testing.T) {
			f := newFixture(t)
			tc.prepare(f)
			rec := do(f.h.call, http.MethodPost, f.validCall(t))
			assertStatus(t, rec, http.StatusBadGateway)
			if got := decode(t, rec)["error"]; got != tc.wantErr {
				t.Errorf("error = %q, want %q", got, tc.wantErr)
			}
		})
	}
}

func TestCallOriginatesAndReturnsClientIden(t *testing.T) {
	f := newFixture(t)
	body := f.validCall(t)
	body["iden"] = "My_iden-42"

	rec := do(f.h.call, http.MethodPost, body)
	assertStatus(t, rec, http.StatusOK)

	if got := decode(t, rec)["iden"]; got != "My_iden-42" {
		t.Errorf("iden = %q", got)
	}
	if f.store.gotDomain != testDomain || f.store.gotUser != testUser {
		t.Errorf("GetCredentials(%q, %q)", f.store.gotDomain, f.store.gotUser)
	}
	if f.kam.gotCompanyID != 7 {
		t.Errorf("ResolveAS(%d), want 7", f.kam.gotCompanyID)
	}
	if f.ami.calls != 1 || f.ami.gotHost != "10.0.0.5" {
		t.Errorf("Originate calls=%d host=%q", f.ami.calls, f.ami.gotHost)
	}
	if f.ami.gotP.ChannelID != "My_iden-42" {
		t.Errorf("ChannelID = %q", f.ami.gotP.ChannelID)
	}
}

func TestCallGeneratesIdenWhenMissing(t *testing.T) {
	f := newFixture(t)
	rec := do(f.h.call, http.MethodPost, f.validCall(t))
	assertStatus(t, rec, http.StatusOK)

	iden := decode(t, rec)["iden"]
	if len(iden) != 16 {
		t.Fatalf("generated iden %q has length %d, want 16", iden, len(iden))
	}
	for _, c := range iden {
		if !strings.ContainsRune(idenAlphabet, c) {
			t.Fatalf("generated iden %q is not base62", iden)
		}
	}
	if f.ami.gotP.ChannelID != iden {
		t.Errorf("ChannelID = %q, want %q", f.ami.gotP.ChannelID, iden)
	}
}

// ------------------------------------------------------------------------ //
//  buildOriginate                                                           //
// ------------------------------------------------------------------------ //

func intp(v int) *int    { return &v }
func boolp(v bool) *bool { return &v }

func TestBuildOriginateDefaults(t *testing.T) {
	f := newFixture(t)
	p := f.h.buildOriginate(callRequest{Destination: testDst}, f.store.creds, "abc")

	want := ami.OriginateParams{
		Channel:        "Local/600123123@click2dial-user",
		Exten:          "600123123",
		Context:        "click2dial-target",
		Priority:       1,
		CallerID:       "101",
		TimeoutMs:      30000,
		ChannelID:      "abc",
		OtherChannelID: "abc-2",
	}
	gotNoVars := p
	gotNoVars.Variables = nil
	if !reflect.DeepEqual(gotNoVars, want) {
		t.Errorf("params = %+v\nwant     %+v", gotNoVars, want)
	}

	wantVars := map[string]string{
		"C2DENDPOINT":      "b3c7t12_101",
		"ORIGINATE_EXTEN":  "101",
		"__BRANDID":        "3",
		"__COMPANYID":      "7",
		"__CLICK2DIALIDEN": "abc",
		"DIAL_TIMEOUT":     "30",
		"MAX_DURATION":     "3600",
		"DIAL_DEF_OPTS":    "",
		"DIAL_OPTS":        "",
	}
	if len(p.Variables) != len(wantVars) {
		t.Errorf("variables = %v, want %v", p.Variables, wantVars)
	}
	for k, v := range wantVars {
		if got, ok := p.Variables[k]; !ok || got != v {
			t.Errorf("variable %s = %q (present %v), want %q", k, got, ok, v)
		}
	}
}

func TestBuildOriginateClientValues(t *testing.T) {
	f := newFixture(t)
	req := callRequest{Destination: testDst, DialTimeout: intp(15), MaxDuration: intp(120), Optimize: boolp(false)}
	p := f.h.buildOriginate(req, f.store.creds, "abc")

	if p.Channel != "Local/600123123@click2dial-user/n" {
		t.Errorf("Channel = %q", p.Channel)
	}
	if p.TimeoutMs != 15000 {
		t.Errorf("TimeoutMs = %d", p.TimeoutMs)
	}
	if p.Variables["DIAL_TIMEOUT"] != "15" || p.Variables["MAX_DURATION"] != "120" {
		t.Errorf("DIAL_TIMEOUT=%q MAX_DURATION=%q", p.Variables["DIAL_TIMEOUT"], p.Variables["MAX_DURATION"])
	}
}

func TestBuildOriginateNonPositiveValuesUseDefaults(t *testing.T) {
	f := newFixture(t)
	for _, v := range []int{0, -5} {
		req := callRequest{Destination: testDst, DialTimeout: intp(v), MaxDuration: intp(v)}
		p := f.h.buildOriginate(req, f.store.creds, "abc")
		if p.TimeoutMs != 30000 || p.Variables["DIAL_TIMEOUT"] != "30" || p.Variables["MAX_DURATION"] != "3600" {
			t.Errorf("value %d: TimeoutMs=%d DIAL_TIMEOUT=%q MAX_DURATION=%q",
				v, p.TimeoutMs, p.Variables["DIAL_TIMEOUT"], p.Variables["MAX_DURATION"])
		}
	}
}

func TestBuildOriginateOptimizeDefaultFromConfig(t *testing.T) {
	f := newFixture(t)
	f.h.defaultOptimize = false
	p := f.h.buildOriginate(callRequest{Destination: testDst}, f.store.creds, "abc")
	if p.Channel != "Local/600123123@click2dial-user/n" {
		t.Errorf("Channel = %q", p.Channel)
	}

	p = f.h.buildOriginate(callRequest{Destination: testDst, Optimize: boolp(true)}, f.store.creds, "abc")
	if p.Channel != "Local/600123123@click2dial-user" {
		t.Errorf("Channel = %q", p.Channel)
	}
}

// ------------------------------------------------------------------------ //
//  CORS                                                                     //
// ------------------------------------------------------------------------ //

func corsRequest(h *Handler, method, origin string) *httptest.ResponseRecorder {
	req := httptest.NewRequest(method, "/challenge", strings.NewReader(`{"aor":"101@example.com"}`))
	if origin != "" {
		req.Header.Set("Origin", origin)
	}
	rec := httptest.NewRecorder()
	h.withCORS(h.challenge)(rec, req)
	return rec
}

func TestCORSPreflight(t *testing.T) {
	f := newFixture(t)
	rec := corsRequest(f.h, http.MethodOptions, "https://allowed.example")
	assertStatus(t, rec, http.StatusNoContent)
	if got := rec.Header().Get("Access-Control-Allow-Origin"); got != "https://allowed.example" {
		t.Errorf("Allow-Origin = %q", got)
	}
	if got := rec.Header().Get("Access-Control-Allow-Methods"); got != "POST, OPTIONS" {
		t.Errorf("Allow-Methods = %q", got)
	}
	if got := rec.Header().Get("Access-Control-Allow-Headers"); got != "Content-Type" {
		t.Errorf("Allow-Headers = %q", got)
	}
}

func TestCORSAllowedOrigin(t *testing.T) {
	f := newFixture(t)
	rec := corsRequest(f.h, http.MethodPost, "https://allowed.example")
	assertStatus(t, rec, http.StatusOK)
	if got := rec.Header().Get("Access-Control-Allow-Origin"); got != "https://allowed.example" {
		t.Errorf("Allow-Origin = %q", got)
	}
}

func TestCORSDisallowedOriginGetsNoHeaders(t *testing.T) {
	f := newFixture(t)
	for _, method := range []string{http.MethodOptions, http.MethodPost} {
		rec := corsRequest(f.h, method, "https://evil.example")
		for _, hdr := range []string{"Access-Control-Allow-Origin", "Access-Control-Allow-Methods", "Access-Control-Allow-Headers"} {
			if got := rec.Header().Get(hdr); got != "" {
				t.Errorf("%s: %s = %q, want none", method, hdr, got)
			}
		}
	}
}

func TestCORSWildcard(t *testing.T) {
	f := newFixture(t)
	f.h.allowedOrigins = []string{"https://other.example", "*"}
	rec := corsRequest(f.h, http.MethodPost, "https://anything.example")
	if got := rec.Header().Get("Access-Control-Allow-Origin"); got != "*" {
		t.Errorf("Allow-Origin = %q, want *", got)
	}
}

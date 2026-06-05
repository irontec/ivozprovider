// Package kamailio resolves which ApplicationServer (Asterisk) handles a given
// company by querying Kamailio's `AsPerCompanyId` htable over JSONRPC/HTTP.
package kamailio

import (
	"bytes"
	"encoding/json"
	"fmt"
	"net/http"
	"strings"
	"time"
)

// htable is the Kamailio hash table mapping companyId -> AS SIP URI. It is
// always this name, so it is not configurable.
const htable = "AsPerCompanyId"

type Client struct {
	rpcURL string
	http   *http.Client
}

func New(rpcURL string) *Client {
	return &Client{
		rpcURL: rpcURL,
		http:   &http.Client{Timeout: 5 * time.Second},
	}
}

type rpcRequest struct {
	Jsonrpc string `json:"jsonrpc"`
	Method  string `json:"method"`
	Params  []any  `json:"params"`
	ID      int    `json:"id"`
}

type rpcResponse struct {
	Result *struct {
		Item *struct {
			Name  json.RawMessage `json:"name"`
			Value string          `json:"value"`
		} `json:"item"`
	} `json:"result"`
	Error *struct {
		Code    int    `json:"code"`
		Message string `json:"message"`
	} `json:"error"`
}

// ResolveAS returns the ApplicationServer host (IP) for a companyId.
// It calls `htable.get AsPerCompanyId s:<companyId>` and extracts the host from
// the resulting SIP URI value (e.g. "sip:127.0.0.1:6060" -> "127.0.0.1").
func (c *Client) ResolveAS(companyID int) (string, error) {
	// Over JSONRPC the key is already a typed JSON string, so it is the plain
	// companyId ("1"); the "s:" prefix is kamcmd syntax, not JSONRPC, and would
	// be looked up as a literal key name.
	reqBody, _ := json.Marshal(rpcRequest{
		Jsonrpc: "2.0",
		Method:  "htable.get",
		Params:  []any{htable, fmt.Sprintf("%d", companyID)},
		ID:      1,
	})

	resp, err := c.http.Post(c.rpcURL, "application/json", bytes.NewReader(reqBody))
	if err != nil {
		return "", fmt.Errorf("kamailio rpc request: %w", err)
	}
	defer resp.Body.Close()

	var rr rpcResponse
	if err := json.NewDecoder(resp.Body).Decode(&rr); err != nil {
		return "", fmt.Errorf("kamailio rpc decode: %w", err)
	}
	if rr.Error != nil {
		return "", fmt.Errorf("kamailio rpc error %d: %s", rr.Error.Code, rr.Error.Message)
	}
	if rr.Result == nil || rr.Result.Item == nil || rr.Result.Item.Value == "" {
		return "", fmt.Errorf("no application server for companyId %d", companyID)
	}

	host := parseSIPHost(rr.Result.Item.Value)
	if host == "" {
		return "", fmt.Errorf("cannot parse AS host from %q", rr.Result.Item.Value)
	}
	return host, nil
}

// parseSIPHost extracts the host part of a SIP URI: "sip:127.0.0.1:6060" -> "127.0.0.1".
func parseSIPHost(v string) string {
	v = strings.TrimSpace(v)
	v = strings.TrimPrefix(v, "sips:")
	v = strings.TrimPrefix(v, "sip:")

	// Drop any uri parameters (;transport=...).
	if i := strings.IndexByte(v, ';'); i >= 0 {
		v = v[:i]
	}
	// Drop the SIP port (we connect to the AMI port from config, not this one).
	if i := strings.LastIndexByte(v, ':'); i >= 0 {
		v = v[:i]
	}

	return strings.TrimSpace(v)
}

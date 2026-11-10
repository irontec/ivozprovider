package kamailio

import (
	"encoding/json"
	"io"
	"net/http"
	"net/http/httptest"
	"strings"
	"testing"
)

// rpcServer answers every request with `reply` after checking it is the
// htable.get JSON-RPC call for companyId 7.
func rpcServer(t *testing.T, reply string) *httptest.Server {
	t.Helper()
	srv := httptest.NewServer(http.HandlerFunc(func(w http.ResponseWriter, r *http.Request) {
		if r.Method != http.MethodPost {
			t.Errorf("method = %s, want POST", r.Method)
		}
		if ct := r.Header.Get("Content-Type"); ct != "application/json" {
			t.Errorf("Content-Type = %q", ct)
		}
		raw, _ := io.ReadAll(r.Body)
		var req struct {
			Jsonrpc string `json:"jsonrpc"`
			Method  string `json:"method"`
			Params  []any  `json:"params"`
		}
		if err := json.Unmarshal(raw, &req); err != nil {
			t.Errorf("request body %q: %v", raw, err)
		}
		if req.Jsonrpc != "2.0" || req.Method != "htable.get" {
			t.Errorf("jsonrpc=%q method=%q", req.Jsonrpc, req.Method)
		}
		// companyId goes as a JSON string, without kamcmd's "s:" prefix.
		if len(req.Params) != 2 || req.Params[0] != "AsPerCompanyId" || req.Params[1] != "7" {
			t.Errorf("params = %#v, want [\"AsPerCompanyId\" \"7\"]", req.Params)
		}
		_, _ = io.WriteString(w, reply)
	}))
	t.Cleanup(srv.Close)
	return srv
}

func TestResolveAS(t *testing.T) {
	srv := rpcServer(t, `{"jsonrpc":"2.0","result":{"item":{"name":"7","value":"sip:10.10.1.5:6060"}},"id":1}`)

	host, err := New(srv.URL).ResolveAS(7)
	if err != nil {
		t.Fatalf("ResolveAS: %v", err)
	}
	if host != "10.10.1.5" {
		t.Errorf("host = %q, want 10.10.1.5", host)
	}
}

func TestResolveASErrors(t *testing.T) {
	cases := map[string]struct {
		reply   string
		wantErr string
	}{
		"rpc error":    {`{"jsonrpc":"2.0","error":{"code":500,"message":"key not found"},"id":1}`, "kamailio rpc error 500: key not found"},
		"empty item":   {`{"jsonrpc":"2.0","result":{"item":{"name":"7","value":""}},"id":1}`, "no application server for companyId 7"},
		"no item":      {`{"jsonrpc":"2.0","result":{},"id":1}`, "no application server for companyId 7"},
		"invalid json": {`not json`, "kamailio rpc decode"},
		"no host":      {`{"jsonrpc":"2.0","result":{"item":{"name":"7","value":"sip:"}},"id":1}`, "cannot parse AS host"},
	}
	for name, tc := range cases {
		t.Run(name, func(t *testing.T) {
			srv := rpcServer(t, tc.reply)
			_, err := New(srv.URL).ResolveAS(7)
			if err == nil || !strings.Contains(err.Error(), tc.wantErr) {
				t.Errorf("err = %v, want containing %q", err, tc.wantErr)
			}
		})
	}
}

func TestResolveASUnreachable(t *testing.T) {
	srv := httptest.NewServer(http.NotFoundHandler())
	url := srv.URL
	srv.Close()

	if _, err := New(url).ResolveAS(7); err == nil || !strings.Contains(err.Error(), "kamailio rpc request") {
		t.Errorf("err = %v", err)
	}
}

func TestParseSIPHost(t *testing.T) {
	cases := map[string]string{
		"sip:127.0.0.1:6060":               "127.0.0.1",
		"sips:127.0.0.1:6061":              "127.0.0.1",
		"sip:127.0.0.1":                    "127.0.0.1",
		"sip:as1.example.com:6060":         "as1.example.com",
		"sip:127.0.0.1:6060;transport=udp": "127.0.0.1",
		"sip:127.0.0.1;transport=tcp":      "127.0.0.1",
		"  sip:127.0.0.1:6060  ":           "127.0.0.1",
		"sip: 127.0.0.1 :6060":             "127.0.0.1",
		"127.0.0.1:6060":                   "127.0.0.1",
	}
	for in, want := range cases {
		if got := parseSIPHost(in); got != want {
			t.Errorf("parseSIPHost(%q) = %q, want %q", in, got, want)
		}
	}
}

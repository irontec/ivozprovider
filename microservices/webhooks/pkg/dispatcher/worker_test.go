package dispatcher

import (
	"net/http"
	"net/http/httptest"
	"strconv"
	"strings"
	"testing"
	"time"

	logger "github.com/sirupsen/logrus"
	"github.com/sirupsen/logrus/hooks/test"
	"irontec.com/webhooks/pkg/db"
)

// Secret fragments a webhook URI may carry. None of them may reach the log.
var uriSecrets = []string{
	"alice", "s3cr3tpass", "s3cr",
	"/v1/webhooks/acme/odn_wh_live_PATHTOKEN",
	"odn_wh_live_PATHTOKEN",
	"QUERYTOKEN", "token=",
	"FRAGMENT",
}

func secretURI(base string) string {
	scheme, host, _ := strings.Cut(base, "://")
	return scheme + "://alice:s3cr3tpass@" + host +
		"/v1/webhooks/acme/odn_wh_live_PATHTOKEN?token=QUERYTOKEN#FRAGMENT"
}

func secretWebhook(uri string) db.Webhook {
	return db.Webhook{ID: 7, Name: "acme-crm", URI: uri}
}

func captureLog(t *testing.T) *test.Hook {
	t.Helper()
	hook := test.NewGlobal()
	previous := logger.GetLevel()
	logger.SetLevel(logger.TraceLevel)
	t.Cleanup(func() {
		logger.SetLevel(previous)
		logger.StandardLogger().ReplaceHooks(make(logger.LevelHooks))
	})
	return hook
}

func assertLoggedWithoutSecrets(t *testing.T, hook *test.Hook, level logger.Level, wants ...string) {
	t.Helper()
	entries := hook.AllEntries()
	if len(entries) != 1 {
		t.Fatalf("expected 1 log entry, got %d", len(entries))
	}
	entry := entries[0]
	if entry.Level != level {
		t.Errorf("expected level %s, got %s: %q", level, entry.Level, entry.Message)
	}
	for _, secret := range uriSecrets {
		if strings.Contains(entry.Message, secret) {
			t.Errorf("log leaks %q: %q", secret, entry.Message)
		}
	}
	for _, want := range append([]string{"[webhook:7]", "acme-crm"}, wants...) {
		if !strings.Contains(entry.Message, want) {
			t.Errorf("log lacks %q: %q", want, entry.Message)
		}
	}
}

func TestPostHTTPLogsSuccessfulDeliveryWithoutSecrets(t *testing.T) {
	hook := captureLog(t)
	server := httptest.NewServer(http.HandlerFunc(func(w http.ResponseWriter, r *http.Request) {
		w.WriteHeader(http.StatusOK)
	}))
	defer server.Close()

	webhook := secretWebhook(secretURI(server.URL))
	postHTTP(server.Client(), webhook, `{}`)

	assertLoggedWithoutSecrets(t, hook, logger.DebugLevel, server.URL, "200")
}

func TestPostHTTPLogsRejectedDeliveryWithoutSecrets(t *testing.T) {
	for _, status := range []int{http.StatusNotFound, http.StatusInternalServerError} {
		t.Run(http.StatusText(status), func(t *testing.T) {
			hook := captureLog(t)
			server := httptest.NewServer(http.HandlerFunc(func(w http.ResponseWriter, r *http.Request) {
				w.WriteHeader(status)
			}))
			defer server.Close()

			webhook := secretWebhook(secretURI(server.URL))
			postHTTP(server.Client(), webhook, `{}`)

			assertLoggedWithoutSecrets(t, hook, logger.WarnLevel, server.URL, strconv.Itoa(status))
		})
	}
}

func TestPostHTTPLogsRefusedConnectionWithoutSecrets(t *testing.T) {
	hook := captureLog(t)
	server := httptest.NewServer(http.NotFoundHandler())
	base := server.URL
	server.Close()

	webhook := secretWebhook(secretURI(base))
	postHTTP(http.DefaultClient, webhook, `{}`)

	assertLoggedWithoutSecrets(t, hook, logger.ErrorLevel, base, "connection refused")
}

func TestPostHTTPLogsTimeoutWithoutSecrets(t *testing.T) {
	hook := captureLog(t)
	release := make(chan struct{})
	server := httptest.NewServer(http.HandlerFunc(func(w http.ResponseWriter, r *http.Request) {
		<-release
	}))
	defer server.Close()
	defer close(release)

	client := server.Client()
	client.Timeout = 50 * time.Millisecond
	webhook := secretWebhook(secretURI(server.URL))
	postHTTP(client, webhook, `{}`)

	assertLoggedWithoutSecrets(t, hook, logger.ErrorLevel, server.URL, "Client.Timeout exceeded")
}

func TestPostHTTPLogsUnparseableRedirectWithoutSecrets(t *testing.T) {
	hook := captureLog(t)
	server := httptest.NewServer(http.HandlerFunc(func(w http.ResponseWriter, r *http.Request) {
		w.Header().Set("Location", "https://elsewhere.example/v1/webhooks/acme/odn_wh_live_PATHTOKEN%zz?token=QUERYTOKEN")
		w.WriteHeader(http.StatusFound)
	}))
	defer server.Close()

	webhook := secretWebhook(secretURI(server.URL))
	postHTTP(server.Client(), webhook, `{}`)

	assertLoggedWithoutSecrets(t, hook, logger.ErrorLevel, server.URL, "Location header")
}

func TestPostHTTPLogsMalformedUserinfoWithoutSecrets(t *testing.T) {
	hook := captureLog(t)
	server := httptest.NewServer(http.NotFoundHandler())
	defer server.Close()

	// An unescaped "/" in the password makes the URI unparseable.
	host := strings.TrimPrefix(server.URL, "http://")
	uri := "http://alice:s3cr/3tpass@" + host + "/v1/webhooks/acme/odn_wh_live_PATHTOKEN?token=QUERYTOKEN"
	webhook := secretWebhook(uri)
	postHTTP(server.Client(), webhook, `{}`)

	assertLoggedWithoutSecrets(t, hook, logger.ErrorLevel, "<invalid URI>", "invalid port")
}

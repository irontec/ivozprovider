// Package digest implements the HTTP-Digest-style authentication used by the
// click2call service: a server-issued, single-use nonce (challenge) plus the
// verification of the client's response, which proves knowledge of the SIP
// terminal password without ever transmitting it.
//
//	HA1      = MD5(username : realm : password)
//	HA2      = MD5(destination)              // binds the proof to this call
//	response = MD5(HA1 : nonce : HA2)
package digest

import (
	"crypto/hmac"
	"crypto/md5"
	"crypto/rand"
	"crypto/sha256"
	"crypto/subtle"
	"encoding/hex"
	"fmt"
	"strconv"
	"strings"
	"sync"
	"time"
)

// Manager issues and validates nonces. A nonce is self-validating
// (HMAC over ts|aor|rand with a server secret) and single-use (tracked in
// memory with a TTL); no shared state with the database is needed.
type Manager struct {
	secret []byte
	ttl    time.Duration

	mu   sync.Mutex
	used map[string]time.Time // nonce -> expiry, to reject replays
}

func NewManager(secret string, ttlSeconds int) *Manager {
	if ttlSeconds <= 0 {
		ttlSeconds = 30
	}
	return &Manager{
		secret: []byte(secret),
		ttl:    time.Duration(ttlSeconds) * time.Second,
		used:   make(map[string]time.Time),
	}
}

// NewNonce returns a fresh nonce bound to the given AoR.
// Format: "<ts>.<randHex>.<hmacHex>".
func (m *Manager) NewNonce(aor string) (string, error) {
	ts := time.Now().Unix()

	rnd := make([]byte, 8)
	if _, err := rand.Read(rnd); err != nil {
		return "", err
	}
	randHex := hex.EncodeToString(rnd)

	return fmt.Sprintf("%d.%s.%s", ts, randHex, m.sign(ts, aor, randHex)), nil
}

func (m *Manager) sign(ts int64, aor, randHex string) string {
	h := hmac.New(sha256.New, m.secret)
	fmt.Fprintf(h, "%d|%s|%s", ts, aor, randHex)
	return hex.EncodeToString(h.Sum(nil))
}

// ValidateNonce verifies the signature, freshness and single-use of a nonce for
// a given AoR. On success the nonce is consumed (any later use is rejected),
// which also prevents online brute-forcing of the response over one nonce.
func (m *Manager) ValidateNonce(aor, nonce string) error {
	parts := strings.Split(nonce, ".")
	if len(parts) != 3 {
		return fmt.Errorf("malformed nonce")
	}

	ts, err := strconv.ParseInt(parts[0], 10, 64)
	if err != nil {
		return fmt.Errorf("malformed nonce timestamp")
	}

	expected := m.sign(ts, aor, parts[1])
	if subtle.ConstantTimeCompare([]byte(expected), []byte(parts[2])) != 1 {
		return fmt.Errorf("bad nonce signature")
	}

	age := time.Since(time.Unix(ts, 0))
	if age < 0 || age > m.ttl {
		return fmt.Errorf("nonce expired")
	}

	m.mu.Lock()
	defer m.mu.Unlock()
	m.gcLocked()
	if _, seen := m.used[nonce]; seen {
		return fmt.Errorf("nonce already used")
	}
	m.used[nonce] = time.Unix(ts, 0).Add(m.ttl)

	return nil
}

// gcLocked drops expired entries from the used-nonce set. Caller holds m.mu.
func (m *Manager) gcLocked() {
	now := time.Now()
	for k, exp := range m.used {
		if now.After(exp) {
			delete(m.used, k)
		}
	}
}

func md5hex(s string) string {
	sum := md5.Sum([]byte(s))
	return hex.EncodeToString(sum[:])
}

// Response computes the expected digest response.
func Response(username, realm, password, nonce, destination string) string {
	ha1 := md5hex(username + ":" + realm + ":" + password)
	ha2 := md5hex(destination)
	return md5hex(ha1 + ":" + nonce + ":" + ha2)
}

// Verify checks the client's response in constant time.
func Verify(response, username, realm, password, nonce, destination string) bool {
	expected := Response(username, realm, password, nonce, destination)
	return subtle.ConstantTimeCompare(
		[]byte(strings.ToLower(response)),
		[]byte(expected),
	) == 1
}

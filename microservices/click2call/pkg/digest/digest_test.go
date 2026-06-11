package digest

import (
	"strings"
	"testing"
)

const (
	testUser  = "myuser"
	testRealm = "host.example.org"
	testPass  = "s3cr3t"
	testDest  = "+34944010101"
)

func TestVerifyValidResponse(t *testing.T) {
	m := NewManager("server-secret", 30)
	aor := testUser + "@" + testRealm

	nonce, err := m.NewNonce(aor)
	if err != nil {
		t.Fatalf("NewNonce: %v", err)
	}

	// Client side: compute the response with the password it holds.
	resp := Response(testUser, testRealm, testPass, nonce, testDest)

	if err := m.ValidateNonce(aor, nonce); err != nil {
		t.Fatalf("ValidateNonce should pass: %v", err)
	}
	if !Verify(resp, testUser, testRealm, testPass, nonce, testDest) {
		t.Fatal("Verify should succeed for a correct response")
	}
}

func TestVerifyWrongPassword(t *testing.T) {
	m := NewManager("server-secret", 30)
	aor := testUser + "@" + testRealm
	nonce, _ := m.NewNonce(aor)

	resp := Response(testUser, testRealm, "wrong-pass", nonce, testDest)
	if Verify(resp, testUser, testRealm, testPass, nonce, testDest) {
		t.Fatal("Verify must fail for a wrong password")
	}
}

func TestVerifyWrongDestination(t *testing.T) {
	m := NewManager("server-secret", 30)
	aor := testUser + "@" + testRealm
	nonce, _ := m.NewNonce(aor)

	// Response computed for a different destination must not validate this call.
	resp := Response(testUser, testRealm, testPass, nonce, "+34911111111")
	if Verify(resp, testUser, testRealm, testPass, nonce, testDest) {
		t.Fatal("Verify must be bound to the destination")
	}
}

func TestNonceSingleUse(t *testing.T) {
	m := NewManager("server-secret", 30)
	aor := testUser + "@" + testRealm
	nonce, _ := m.NewNonce(aor)

	if err := m.ValidateNonce(aor, nonce); err != nil {
		t.Fatalf("first use should pass: %v", err)
	}
	if err := m.ValidateNonce(aor, nonce); err == nil {
		t.Fatal("second use of the same nonce must be rejected")
	}
}

func TestNonceTamperedSignature(t *testing.T) {
	m := NewManager("server-secret", 30)
	aor := testUser + "@" + testRealm
	nonce, _ := m.NewNonce(aor)

	// Flip the last character of the HMAC part.
	parts := strings.Split(nonce, ".")
	last := parts[2]
	c := byte('a')
	if last[len(last)-1] == 'a' {
		c = 'b'
	}
	parts[2] = last[:len(last)-1] + string(c)
	tampered := strings.Join(parts, ".")

	if err := m.ValidateNonce(aor, tampered); err == nil {
		t.Fatal("tampered nonce must be rejected")
	}
}

func TestNonceWrongAoR(t *testing.T) {
	m := NewManager("server-secret", 30)
	nonce, _ := m.NewNonce(testUser + "@" + testRealm)

	// A nonce issued for one AoR must not validate for another.
	if err := m.ValidateNonce("eve@"+testRealm, nonce); err == nil {
		t.Fatal("nonce bound to a different AoR must be rejected")
	}
}

func TestNonceExpired(t *testing.T) {
	m := NewManager("server-secret", 1)
	aor := testUser + "@" + testRealm

	// Build a correctly-signed nonce with an old (epoch) timestamp so freshness
	// validation rejects it despite a valid signature.
	expired := "0.00." + m.sign(0, aor, "00")
	if err := m.ValidateNonce(aor, expired); err == nil {
		t.Fatal("expired nonce must be rejected")
	}
}

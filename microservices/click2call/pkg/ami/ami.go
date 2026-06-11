// Package ami is a minimal Asterisk Manager Interface client: it connects to an
// ApplicationServer, logs in and sends a single asynchronous Originate that
// reuses the existing click2dial dialplan to fire the two call legs.
package ami

import (
	"bufio"
	"crypto/rand"
	"encoding/hex"
	"fmt"
	"net"
	"sort"
	"strings"
	"time"
)

type Client struct {
	user   string
	secret string
	port   int
}

func New(user, secret string, port int) *Client {
	return &Client{user: user, secret: secret, port: port}
}

// OriginateParams describes the AMI Originate to send.
type OriginateParams struct {
	Channel        string
	Exten          string
	Context        string
	Priority       int
	CallerID       string
	TimeoutMs      int
	ChannelID      string
	OtherChannelID string
	Variables      map[string]string
}

// Originate connects to the AMI of `host` (on the configured port), logs in and
// sends the Originate action. The action is async, so Asterisk answers with
// "Originate successfully queued" once the request is accepted.
func (c *Client) Originate(host string, p OriginateParams) error {
	addr := fmt.Sprintf("%s:%d", host, c.port)

	conn, err := net.DialTimeout("tcp", addr, 10*time.Second)
	if err != nil {
		return fmt.Errorf("ami connect %s: %w", addr, err)
	}
	defer conn.Close()
	_ = conn.SetDeadline(time.Now().Add(15 * time.Second))

	r := bufio.NewReader(conn)

	// Banner line ("Asterisk Call Manager/x.y.z").
	if _, err := r.ReadString('\n'); err != nil {
		return fmt.Errorf("ami banner: %w", err)
	}

	// Login. Correlate the reply by ActionID, skipping async events
	// (e.g. FullyBooted) that Asterisk interleaves.
	loginID := newActionID()
	login := fmt.Sprintf(
		"Action: Login\r\nUsername: %s\r\nSecret: %s\r\nActionID: %s\r\n\r\n",
		c.user, c.secret, loginID,
	)
	if _, err := conn.Write([]byte(login)); err != nil {
		return fmt.Errorf("ami login write: %w", err)
	}
	resp, err := readResponse(r, loginID)
	if err != nil {
		return fmt.Errorf("ami login read: %w", err)
	}
	if !isSuccess(resp) {
		return fmt.Errorf("ami login failed: %s", oneLine(resp))
	}

	// Originate.
	originateID := newActionID()
	if _, err := conn.Write([]byte(buildOriginate(p, originateID))); err != nil {
		return fmt.Errorf("ami originate write: %w", err)
	}
	resp, err = readResponse(r, originateID)
	if err != nil {
		return fmt.Errorf("ami originate read: %w", err)
	}
	if !isSuccess(resp) {
		return fmt.Errorf("ami originate rejected: %s", oneLine(resp))
	}

	// Best-effort logoff.
	_, _ = conn.Write([]byte("Action: Logoff\r\n\r\n"))

	return nil
}

func buildOriginate(p OriginateParams, actionID string) string {
	var b strings.Builder
	b.WriteString("Action: Originate\r\n")
	b.WriteString("ActionID: " + actionID + "\r\n")
	b.WriteString("Channel: " + p.Channel + "\r\n")
	b.WriteString("Exten: " + p.Exten + "\r\n")
	b.WriteString("Context: " + p.Context + "\r\n")
	fmt.Fprintf(&b, "Priority: %d\r\n", p.Priority)
	b.WriteString("CallerID: " + p.CallerID + "\r\n")
	fmt.Fprintf(&b, "Timeout: %d\r\n", p.TimeoutMs)
	b.WriteString("Async: true\r\n")
	if p.ChannelID != "" {
		b.WriteString("ChannelId: " + p.ChannelID + "\r\n")
	}
	if p.OtherChannelID != "" {
		b.WriteString("OtherChannelId: " + p.OtherChannelID + "\r\n")
	}

	// Deterministic order for readability/testing.
	keys := make([]string, 0, len(p.Variables))
	for k := range p.Variables {
		keys = append(keys, k)
	}
	sort.Strings(keys)
	for _, k := range keys {
		b.WriteString("Variable: " + k + "=" + p.Variables[k] + "\r\n")
	}

	b.WriteString("\r\n")
	return b.String()
}

// readResponse reads AMI message blocks, skipping asynchronous events and
// unrelated replies, until it finds the one carrying our ActionID.
func readResponse(r *bufio.Reader, actionID string) (string, error) {
	for {
		block, err := readBlock(r)
		if err != nil {
			return "", err
		}
		if strings.Contains(block, "ActionID: "+actionID) {
			return block, nil
		}
		// Otherwise it's an async event or another action's reply: skip it.
	}
}

// newActionID returns a random hex token to correlate an action with its reply.
func newActionID() string {
	buf := make([]byte, 8)
	if _, err := rand.Read(buf); err != nil {
		return "c2c-action"
	}
	return hex.EncodeToString(buf)
}

// readBlock reads an AMI message (lines up to the blank line terminator).
func readBlock(r *bufio.Reader) (string, error) {
	var b strings.Builder
	for {
		line, err := r.ReadString('\n')
		if err != nil {
			return b.String(), err
		}
		if line == "\r\n" || line == "\n" {
			break
		}
		b.WriteString(line)
	}
	return b.String(), nil
}

func isSuccess(block string) bool {
	return strings.Contains(block, "Response: Success")
}

func oneLine(block string) string {
	return strings.TrimSpace(strings.ReplaceAll(block, "\r\n", " "))
}

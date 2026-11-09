package ami

import (
	"bufio"
	"net"
	"strconv"
	"strings"
	"testing"
)

// fakeAMI is a scripted Asterisk Manager Interface on a loopback port. It
// records every action block it receives.
type fakeAMI struct {
	ln      net.Listener
	actions chan map[string][]string
	done    chan struct{}
}

type amiScript struct {
	loginOK     bool
	originateOK bool
}

func startFakeAMI(t *testing.T, network, addr string, s amiScript) *fakeAMI {
	t.Helper()
	ln, err := net.Listen(network, addr)
	if err != nil {
		t.Skipf("cannot listen on %s %s: %v", network, addr, err)
	}
	f := &fakeAMI{ln: ln, actions: make(chan map[string][]string, 10), done: make(chan struct{})}
	t.Cleanup(func() { _ = ln.Close(); <-f.done })

	go func() {
		defer close(f.done)
		conn, err := ln.Accept()
		if err != nil {
			return
		}
		defer conn.Close()
		r := bufio.NewReader(conn)
		w := func(s string) { _, _ = conn.Write([]byte(s)) }

		w("Asterisk Call Manager/7.0.3\r\n")

		login, ok := readAction(r)
		if !ok {
			return
		}
		f.actions <- login
		// Async event interleaved before the reply: must be skipped.
		w("Event: FullyBooted\r\nPrivilege: system,all\r\nStatus: Fully Booted\r\n\r\n")
		if !s.loginOK {
			w("Response: Error\r\nActionID: " + login["ActionID"][0] + "\r\nMessage: Authentication failed\r\n\r\n")
			return
		}
		w("Response: Success\r\nActionID: " + login["ActionID"][0] + "\r\nMessage: Authentication accepted\r\n\r\n")

		orig, ok := readAction(r)
		if !ok {
			return
		}
		f.actions <- orig
		// Unrelated reply and event before ours.
		w("Response: Success\r\nActionID: someone-else\r\nMessage: Pong\r\n\r\n")
		w("Event: Newchannel\r\nChannel: PJSIP/foo-00000001\r\n\r\n")
		if !s.originateOK {
			w("Response: Error\r\nActionID: " + orig["ActionID"][0] + "\r\nMessage: Originate failed\r\n\r\n")
			return
		}
		w("Response: Success\r\nActionID: " + orig["ActionID"][0] + "\r\nMessage: Originate successfully queued\r\n\r\n")

		if logoff, ok := readAction(r); ok {
			f.actions <- logoff
		}
	}()
	return f
}

func (f *fakeAMI) hostPort(t *testing.T) (string, int) {
	t.Helper()
	host, port, err := net.SplitHostPort(f.ln.Addr().String())
	if err != nil {
		t.Fatal(err)
	}
	p, _ := strconv.Atoi(port)
	return host, p
}

// readAction parses one "Key: Value" block terminated by an empty line.
func readAction(r *bufio.Reader) (map[string][]string, bool) {
	out := map[string][]string{}
	for {
		line, err := r.ReadString('\n')
		if err != nil {
			return nil, false
		}
		line = strings.TrimRight(line, "\r\n")
		if line == "" {
			return out, true
		}
		k, v, _ := strings.Cut(line, ": ")
		out[k] = append(out[k], v)
	}
}

func sampleParams() OriginateParams {
	return OriginateParams{
		Channel:        "Local/600123123@click2dial-user",
		Exten:          "600123123",
		Context:        "click2dial-target",
		Priority:       1,
		CallerID:       "101",
		TimeoutMs:      30000,
		ChannelID:      "abc",
		OtherChannelID: "abc-2",
		Variables:      map[string]string{"MAX_DURATION": "3600", "C2DENDPOINT": "b1c1t1_101", "__BRANDID": "1"},
	}
}

func TestOriginate(t *testing.T) {
	ami := startFakeAMI(t, "tcp", "127.0.0.1:0", amiScript{loginOK: true, originateOK: true})
	host, port := ami.hostPort(t)

	if err := New("c2c", "amisecret", port).Originate(host, sampleParams()); err != nil {
		t.Fatalf("Originate: %v", err)
	}

	login := <-ami.actions
	if login["Action"][0] != "Login" || login["Username"][0] != "c2c" || login["Secret"][0] != "amisecret" {
		t.Errorf("login = %v", login)
	}
	orig := <-ami.actions
	want := map[string]string{
		"Action":         "Originate",
		"Channel":        "Local/600123123@click2dial-user",
		"Exten":          "600123123",
		"Context":        "click2dial-target",
		"Priority":       "1",
		"CallerID":       "101",
		"Timeout":        "30000",
		"Async":          "true",
		"ChannelId":      "abc",
		"OtherChannelId": "abc-2",
	}
	for k, v := range want {
		if got := orig[k]; len(got) != 1 || got[0] != v {
			t.Errorf("originate %s = %v, want %q", k, got, v)
		}
	}
	if orig["ActionID"][0] == login["ActionID"][0] {
		t.Error("login and originate share an ActionID")
	}
	if logoff := <-ami.actions; logoff["Action"][0] != "Logoff" {
		t.Errorf("last action = %v, want Logoff", logoff)
	}
}

func TestOriginateIPv6Host(t *testing.T) {
	ami := startFakeAMI(t, "tcp6", "[::1]:0", amiScript{loginOK: true, originateOK: true})
	host, port := ami.hostPort(t)

	if err := New("c2c", "amisecret", port).Originate(host, sampleParams()); err != nil {
		t.Fatalf("Originate on %s: %v", host, err)
	}
}

func TestOriginateLoginRejected(t *testing.T) {
	ami := startFakeAMI(t, "tcp", "127.0.0.1:0", amiScript{loginOK: false})
	host, port := ami.hostPort(t)

	err := New("c2c", "wrong", port).Originate(host, sampleParams())
	if err == nil || !strings.Contains(err.Error(), "ami login failed") || !strings.Contains(err.Error(), "Authentication failed") {
		t.Errorf("err = %v", err)
	}
}

func TestOriginateRejected(t *testing.T) {
	ami := startFakeAMI(t, "tcp", "127.0.0.1:0", amiScript{loginOK: true, originateOK: false})
	host, port := ami.hostPort(t)

	err := New("c2c", "amisecret", port).Originate(host, sampleParams())
	if err == nil || !strings.Contains(err.Error(), "ami originate rejected") || !strings.Contains(err.Error(), "Originate failed") {
		t.Errorf("err = %v", err)
	}
}

func TestOriginateConnectError(t *testing.T) {
	ln, err := net.Listen("tcp", "127.0.0.1:0")
	if err != nil {
		t.Fatal(err)
	}
	_, port, _ := net.SplitHostPort(ln.Addr().String())
	_ = ln.Close()
	p, _ := strconv.Atoi(port)

	if err := New("c2c", "x", p).Originate("127.0.0.1", sampleParams()); err == nil || !strings.Contains(err.Error(), "ami connect") {
		t.Errorf("err = %v", err)
	}
}

func TestBuildOriginate(t *testing.T) {
	got := buildOriginate(sampleParams(), "id-1")
	want := "Action: Originate\r\n" +
		"ActionID: id-1\r\n" +
		"Channel: Local/600123123@click2dial-user\r\n" +
		"Exten: 600123123\r\n" +
		"Context: click2dial-target\r\n" +
		"Priority: 1\r\n" +
		"CallerID: 101\r\n" +
		"Timeout: 30000\r\n" +
		"Async: true\r\n" +
		"ChannelId: abc\r\n" +
		"OtherChannelId: abc-2\r\n" +
		"Variable: C2DENDPOINT=b1c1t1_101\r\n" +
		"Variable: MAX_DURATION=3600\r\n" +
		"Variable: __BRANDID=1\r\n" +
		"\r\n"
	if got != want {
		t.Errorf("buildOriginate =\n%q\nwant\n%q", got, want)
	}
	for i := 0; i < 20; i++ {
		if again := buildOriginate(sampleParams(), "id-1"); again != got {
			t.Fatal("variable order is not stable")
		}
	}
}

func TestBuildOriginateOmitsEmptyChannelIDs(t *testing.T) {
	p := sampleParams()
	p.ChannelID, p.OtherChannelID = "", ""
	got := buildOriginate(p, "id-1")
	if strings.Contains(got, "ChannelId") {
		t.Errorf("unexpected ChannelId in %q", got)
	}
}

# click2call microservice

Go service that originates *click-to-call* calls in IvozProvider without requiring a portal JWT:
it authenticates with the **terminal's own SIP credentials via HTTP Digest** (the password never
travels) and fires, over AMI, the `Originate` that reuses the existing `click2dial` dialplan
(leg 1 = the user's terminal rings; on answer, leg 2 = the destination).

Intended to be consumed by a **browser extension** that detects phone numbers on web pages and,
on click, calls this service.

## Flow (challenge → call)

```
1) POST /challenge { aor }
   → 200 { nonce, realm }

2) POST /call { aor, nonce, response, destination,
                iden?, maxDuration?, dialTimeout?, optimize? }
   → 200 { iden }            (or 400/401/403/502)
```

A `200` from `/call` means Asterisk has **queued** the `Originate` (the AMI action is async and
answers "Originate successfully queued"), not that the call has been established. It can still
fail afterwards (the terminal does not answer, the destination fails…) and there is no endpoint
to query the call state: use the returned `iden` to follow it in the realtime data.

Leg 1 is sent to the user's terminal with `Call-Info: <…>;answer-after=0` (dialplan context
`click2dial-user-headers`, `asterisk/config/dialplan/click2dial.conf`). Terminals that honour
that header **auto-answer**, so the call towards the destination starts without the user touching
the phone.

- `aor`: the terminal's `username@domain`.
- `realm` (returned by `/challenge`) = the **domain** part of the AoR.
- `destination`: destination number (`^[+*0-9]+$`).
- `iden` (optional): caller-supplied id (`^[A-Za-z0-9_-]{1,32}$`); if omitted, the service
  generates one (16-char base62) and returns it. It is used as the AMI `ChannelId` and is
  propagated on the 2nd leg (the call generated towards the destination when leg 1 answers) to
  the proxy as the SIP header `X-Info-Click2Dial-iden`. Kamailio publishes it as `IDEN` in the
  realtime events of leg 2; it is **not** stored in the CDRs.
- `maxDuration` (ms, default 10800000), `dialTimeout` (s, default 30), `optimize` (bool, default false).

### Digest computation (client side)

```
HA1      = MD5(username : realm : password)
HA2      = MD5(destination)
response = MD5(HA1 : nonce : HA2)
```

Only `response` travels; the password never leaves the client. The server recomputes and compares
in constant time. The `nonce` is server-issued (HMAC-signed + freshness `nonce_ttl` + single-use),
so there is no replay.

> In the browser: `crypto.subtle` does **not** provide MD5; use `blueimp-md5`/`crypto-js`. CORS is
> solved by declaring the service origin in the extension's `host_permissions`.

## Error codes

| Code | Reason |
|------|--------|
| 400 | invalid JSON/AoR/destination/iden |
| 401 | invalid, expired or reused nonce |
| 403 | AoR not eligible (no terminal+endpoint+user+extension) or wrong digest |
| 502 | could not resolve the AS (Kamailio) or originate (AMI) |

(The exact reason is not leaked between "does not exist" and "wrong password"; only the log
tells them apart, see below.)

## Authentication failure log

Every `401`/`403` from `/call` writes one `warning` line with a fixed message and these fields:

| Field | Value |
|-------|-------|
| `status` | `401` or `403` |
| `reason` | `invalid_nonce` (401: invalid, expired, reused or issued for another AoR), `not_eligible` (403: AoR not eligible), `bad_response` (403: wrong digest) |
| `aor` | requested AoR |
| `dst` | requested destination |
| `ip` | IP of the TCP connection (`RemoteAddr`, without the port) |

```
level=warning msg="click2call auth failed" aor=101@example.com dst=600123123 ip=203.0.113.7 reason=bad_response status=403
```

The format is stable (logrus text formatter: fields sorted alphabetically), meant for alerting or
fail2ban. `aor` and `dst` are validated before logging, so they cannot inject lines. The
`response`, the `nonce`, the terminal password and the `iden` are never logged, not even on the
success line (`click2call originated: …`, which also carries `ip`). `400`s and `/challenge`
are not logged. `X-Forwarded-For`/`X-Real-IP` are ignored on purpose: the service is exposed
directly, and a client could forge them.

There is no rate limit in the service; calls are subject to the platform's simultaneous call
limits.

## Configuration

`configs/config.yml` is versioned in this repository and is the conffile of the
`ivozprovider-click2call` package (`/opt/irontec/ivozprovider/microservices/click2call/configs/config.yml`).
On install, the package postinst sets the DB password (from debconf, `ivozprovider/mysql_password`)
and generates a random `digest.secret`, so with several portals nodes set the same value on every
node (if the environment is managed by configuration management, let it set the secret).

Sections: `server` (listen, TLS, CORS), `digest` (secret, nonce_ttl), `db`
(`data.ivozprovider.local:3306`), `ami` (credentials common to all ASes), `kamailio` (`rpc_url`
JSONRPC), `call` (defaults), `log`.

The service serves **HTTPS directly** on port 9090 with the portals certificate
(`/etc/ssl/certs/ivozprovider-portals.pem`, `/etc/ssl/private/ivozprovider-portals.key`). If
`server.tls_cert`/`tls_key` are empty it serves plain HTTP: use that only for testing (behind a
proxy, the authentication failure log would show the proxy's IP).

## Single instance

Used nonces are kept in memory (`pkg/digest/digest.go`), so only **one instance** may be active.
In a cluster, pacemaker guarantees it (primitive `CLICK2CALL`, colocated with `IP-HA-PORTALS`).
On a failover, nonces issued in the last `nonce_ttl` seconds (30 by default) stop being valid and
the client has to request a new one. All nodes must share `digest.secret`.

## Internal resolution

1. **Credentials** (MySQL, INNER JOINs): `domain`+`username` → `brandId`, `companyId`,
   `password`, `sorcery_id` (C2DENDPOINT), `extension`. No row → not eligible (403).
2. **ApplicationServer** (Kamailio JSONRPC): `htable.get AsPerCompanyId <companyId>` (over JSONRPC
   the key is the plain companyId string, not the `s:` kamcmd syntax); from the `value`
   `sip:<ip>:<port>` it takes `<ip>`. The AMI is reached on `ami.port` (5038).
3. **Originate** (AMI): `Local/<dst>@click2dial-user[/n]`, ctx `click2dial-target`,
   `ChannelId=<iden>`, variables `C2DENDPOINT`, `ORIGINATE_EXTEN`, `__BRANDID`/`__COMPANYID`
   (inheritable, required for the X-Info-* headers), `__CLICK2DIALIDEN=<iden>` (inheritable, so
   the 2nd leg emits `X-Info-Click2Dial-iden`), `DIAL_TIMEOUT`, `MAX_DURATION`…

## Build / test

```bash
scripts/build.sh        # go mod download + build -> ./originate
tests/test-build.sh     # build + go vet + go test ./...
tests/test-codestyle.sh # fails if gofmt -l lists any file
```

Both run in Jenkins (stage `microservice-click2call`) with the Go version of the CI image (1.19).

`client/client.py` is a stdlib Python test client (challenge → digest → call). The browser
extension is out of scope, but this README documents its contract.

## Layout

```
cmd/originate/main.go        startup
pkg/config/viper.go       configuration (viper)
pkg/log/logrus.go         logging
pkg/server/http.go        /challenge and /call handlers + CORS
pkg/digest/digest.go      single-use HMAC nonce + HA1/response
pkg/db/db.go              credentials query (MySQL)
pkg/kamailio/kamailio.go  ResolveAS over JSONRPC (htable.get)
pkg/ami/ami.go            minimal AMI client (Login + Originate)
client/client.py          stdlib python test client (challenge -> digest -> call)
```

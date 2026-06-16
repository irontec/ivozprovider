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

- `aor`: the terminal's `username@domain`.
- `realm` (returned by `/challenge`) = the **domain** part of the AoR.
- `destination`: destination number (`^[+*0-9]+$`).
- `iden` (optional): caller-supplied id (`^[A-Za-z0-9_-]{1,32}$`); if omitted, the service
  generates one (16-char base62) and returns it. It is used as the AMI `ChannelId` and is
  propagated on the 2nd leg (the call generated towards the destination when leg 1 answers) to
  the proxy as the SIP header `X-Info-Click2Dial-iden`, for correlation.
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

(The exact reason is not leaked between "does not exist" and "wrong password".)

## Configuration

`configs/config.yml` (copy of `config.yml.dist`; **not committed** — it holds the digest secret
and the DB password). Sections: `server` (listen, optional TLS, CORS), `digest`
(secret, nonce_ttl), `db` (`data.ivozprovider.local:3306`), `ami` (credentials common to all ASes),
`kamailio` (`rpc_url` JSONRPC), `call` (defaults), `log`.

If `server.tls_cert`/`tls_key` are empty it serves plain HTTP (to sit behind a TLS proxy).

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
```

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

## Notes (POC)

- In-memory nonce store (single instance). For multi-instance, move it to Redis.
- No rate-limiting on `/challenge`/`/call` (recommended in production).
- A stdlib Python test client lives in `client/` (challenge → digest → call). The production
  browser extension is out of scope, but this README documents its contract.

#!/usr/bin/env python3
"""click2call test client.

Reproduces what a browser extension would do: ask the service for a nonce
(/challenge), compute the HTTP Digest response from the terminal's SIP password
without ever sending it, and place the call (/call).

    HA1      = MD5(username : realm : password)
    HA2      = MD5(destination)
    response = MD5(HA1 : nonce : HA2)

Connection and identity (base_url, aor, password, verify_tls) come from
config.ini (see config.ini.dist). Per-call parameters are CLI arguments:
the destination is positional; iden/max-duration/dial-timeout/optimize are
optional flags (omitted ones fall back to the server defaults). username and
realm are always derived from the AoR. Standard library only.
"""

import argparse
import configparser
import hashlib
import json
import os
import ssl
import sys
import urllib.error
import urllib.request

DEFAULT_CONFIG = os.path.join(os.path.dirname(os.path.abspath(__file__)), "config.ini")


def md5(s):
    return hashlib.md5(s.encode("utf-8")).hexdigest()


def post_json(url, payload, ctx):
    """POST a JSON body; return (status_code, parsed_body)."""
    data = json.dumps(payload).encode("utf-8")
    req = urllib.request.Request(
        url, data=data, method="POST",
        headers={"Content-Type": "application/json"},
    )
    try:
        with urllib.request.urlopen(req, context=ctx, timeout=10) as resp:
            return resp.status, _parse(resp.read())
    except urllib.error.HTTPError as exc:
        return exc.code, _parse(exc.read())


def _parse(raw):
    text = raw.decode("utf-8", "replace") if raw else ""
    try:
        return json.loads(text)
    except ValueError:
        return text


def main(argv=None):
    p = argparse.ArgumentParser(description="click2call test client (challenge -> call)")
    p.add_argument("destination",
                   help="number to call, dialed exactly as the user would type it")
    p.add_argument("-c", "--config", default=DEFAULT_CONFIG,
                   help="path to config.ini")
    # Per-call parameters; omitted ones fall back to the server defaults.
    p.add_argument("--iden",
                   help="caller-supplied call id (default: the server generates one)")
    p.add_argument("--max-duration", type=int,
                   help="max call duration in ms (default: server default)")
    p.add_argument("--dial-timeout", type=int,
                   help="ring timeout in seconds (default: server default)")
    p.add_argument("--optimize", action="store_true",
                   help="allow Local channel optimization, i.e. drop the /n (default: off)")
    p.add_argument("--dry-run", action="store_true",
                   help="do /challenge and compute the response, but do NOT place the call")
    args = p.parse_args(argv)

    if not os.path.exists(args.config):
        sys.exit("Config not found: %s (copy config.ini.dist to config.ini)" % args.config)

    cfg = configparser.ConfigParser()
    cfg.read(args.config)
    c = cfg["client"]

    base = c.get("base_url").rstrip("/")
    aor = c.get("aor")
    password = c.get("password")
    verify_tls = c.getboolean("verify_tls", fallback=False)

    # username and realm are always derived from the AoR (username@domain).
    aor_user, sep, aor_domain = aor.partition("@")
    if not sep:
        sys.exit("Invalid aor (expected username@domain): %s" % aor)

    ctx = ssl.create_default_context()
    if not verify_tls:
        ctx.check_hostname = False
        ctx.verify_mode = ssl.CERT_NONE

    # 1) Challenge: get a fresh nonce (and the realm to use).
    status, body = post_json(base + "/challenge", {"aor": aor}, ctx)
    if status != 200 or not isinstance(body, dict) or "nonce" not in body:
        sys.exit("challenge failed (HTTP %s): %s" % (status, body))
    nonce = body["nonce"]
    # Prefer the realm the server returns (authoritative); else the AoR domain.
    realm = body.get("realm") or aor_domain
    print("challenge -> nonce=%s realm=%s" % (nonce, realm))

    # 2) Compute the digest response (the password never leaves this script).
    ha1 = md5("%s:%s:%s" % (aor_user, realm, password))
    ha2 = md5(args.destination)
    response = md5("%s:%s:%s" % (ha1, nonce, ha2))

    payload = {
        "aor": aor,
        "nonce": nonce,
        "response": response,
        "destination": args.destination,
    }
    # Optional per-call parameters (only sent when given on the CLI).
    if args.iden:
        payload["iden"] = args.iden
    if args.max_duration is not None:
        payload["maxDuration"] = args.max_duration
    if args.dial_timeout is not None:
        payload["dialTimeout"] = args.dial_timeout
    if args.optimize:
        payload["optimize"] = True

    if args.dry_run:
        print("dry-run -> would POST /call with:")
        print(json.dumps(payload, indent=2))
        return 0

    # 3) Call.
    status, body = post_json(base + "/call", payload, ctx)
    print("call -> HTTP %s: %s" % (status, body))
    return 0 if status == 200 else 1


if __name__ == "__main__":
    sys.exit(main())

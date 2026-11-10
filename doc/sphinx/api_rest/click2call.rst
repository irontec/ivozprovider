.. _click2call:

##########
Click2Call
##########

The **Click2Call** microservice exposes a small HTTP/JSON API that originates
*click-to-call* calls without requiring a portal JWT. It is meant to be consumed
by a **browser extension** that detects phone numbers on web pages and, on click,
asks the service to place the call.

Unlike the role-based REST APIs, this service does **not** use JWT authentication:
the caller proves ownership of a terminal with the **terminal's own SIP
credentials via HTTP Digest**, so the password never travels over the wire.

On success the service fires, over AMI, an ``Originate`` that reuses the existing
``click2dial`` dialplan:

#. **Leg 1**: the user's own terminal rings.
#. **Leg 2**: when the user answers, the call towards the requested ``destination``
   is generated.

.. note::

   This service is shipped as the ``ivozprovider-click2call`` package and serves
   HTTPS directly on its own port (9090 by default, see
   :doc:`../security_and_maintenance/security/firewall`). It is independent from
   the ``/api/platform``, ``/api/brand`` and ``/api/provider`` REST APIs.

*********
Endpoints
*********

The flow always has two steps: first request a challenge, then place the call
signing the destination with the challenge.

.. rubric:: 1) POST /challenge

Requests a single-use ``nonce`` for an Address of Record (AoR).

Request body:

.. code-block:: json

    { "aor": "username@domain" }

Response (``200``):

.. code-block:: json

    { "nonce": "<server-issued nonce>", "realm": "domain" }

- ``aor``: the terminal's ``username@domain``.
- ``realm`` (returned): the **domain** part of the AoR, to be used in the digest.

The ``nonce`` is HMAC-signed, has a configurable freshness (``nonce_ttl``) and is
single-use, so there is no replay. No database access happens at this step.

.. rubric:: 2) POST /call

Places the call. The destination must be signed with a digest computed from the
terminal password and the ``nonce`` obtained above.

Request body:

.. code-block:: json

    {
      "aor": "username@domain",
      "nonce": "<nonce from /challenge>",
      "response": "<digest response>",
      "destination": "+34900000000",
      "iden": "optional-call-id",
      "maxDuration": 10800000,
      "dialTimeout": 30,
      "optimize": false
    }

Response (``200``):

.. code-block:: json

    { "iden": "<call iden>" }

- ``destination``: destination number (``^[+*0-9]+$``).
- ``iden`` (optional): caller-supplied id (``^[A-Za-z0-9_-]{1,32}$``); if omitted,
  the service generates one (16-char base62) and returns it in the response.
- ``maxDuration`` (ms, default ``10800000``), ``dialTimeout`` (s, default ``30``),
  ``optimize`` (bool, default ``false``).

The returned ``iden`` identifies the generated call: it is used as the AMI
``ChannelId`` and is propagated on **leg 2** (the call towards the destination) to
the proxy as the SIP header ``X-Info-Click2Dial-iden``. The proxy publishes it as
``IDEN`` in the realtime events of leg 2, so the call can be correlated with the
originating ``/call`` request. It is **not** stored in the CDRs.

A ``200`` means that Asterisk has **queued** the ``Originate`` (the action is
asynchronous), not that the call has been established. The call can still fail
afterwards (the terminal does not answer, the destination fails...) and there is no
way to query its state: use the ``iden`` to follow it in the realtime data.

.. warning::

   Leg 1 is sent to the user's terminal with the header
   ``Call-Info: <...>;answer-after=0``. Terminals that honour it **answer
   automatically**, so the call towards the destination starts without the user
   touching the phone.

******************
Digest computation
******************

The digest is computed on the client side, MD5-based, and only ``response``
travels (the password never leaves the client):

.. code-block:: text

    HA1      = MD5(username : realm : password)
    HA2      = MD5(destination)
    response = MD5(HA1 : nonce : HA2)

The server recomputes and compares in constant time.

.. note::

   In the browser ``crypto.subtle`` does **not** provide MD5; use a library such as
   ``blueimp-md5`` / ``crypto-js``. CORS is solved by declaring the service origin in
   the extension's ``host_permissions``; the service echoes allowed origins from its
   configuration.

***********
Error codes
***********

==========  ==========================================================================
Code        Reason
==========  ==========================================================================
``400``     invalid JSON / AoR / destination / iden
``401``     invalid, expired or reused nonce
``403``     AoR not eligible (no terminal+endpoint+user+extension) or wrong digest
``502``     could not resolve the Application Server (Kamailio) or originate (AMI)
==========  ==========================================================================

For security, the exact reason is not leaked between "the AoR does not exist" and
"wrong password": both return ``403``. Only the service log tells them apart.

There is no rate limit in the service: the calls it places are subject to the
platform's simultaneous call limits.

***********************
Authentication failures
***********************

Every ``401`` and ``403`` of ``/call`` writes one ``warning`` line to the service
log (``journalctl -u ivozprovider-click2call``), with the fixed message
``click2call auth failed`` and these fields:

- ``status``: ``401`` or ``403``.
- ``reason``: ``invalid_nonce`` (``401``: invalid, expired, reused or issued for
  another AoR), ``not_eligible`` (``403``: the AoR is not eligible) or
  ``bad_response`` (``403``: wrong digest).
- ``aor``: the requested AoR.
- ``dst``: the requested destination.
- ``ip``: the IP address of the TCP connection.

.. code-block:: text

    level=warning msg="click2call auth failed" aor=101@example.com dst=600123123 ip=203.0.113.7 reason=bad_response status=403

The format is stable, so it can be used for alerts or fail2ban. The ``response``,
the ``nonce``, the terminal password and the ``iden`` are never logged.
``X-Forwarded-For`` and similar headers are ignored, because a client could forge
them: the logged IP is always the one of the connection.

*************
Configuration
*************

The configuration file is
``/opt/irontec/ivozprovider/microservices/click2call/configs/config.yml``, a
conffile of the ``ivozprovider-click2call`` package. On install, the package sets
the database password and generates a random ``digest.secret``.

- **TLS**: the service uses the portals certificate
  (``/etc/ssl/certs/ivozprovider-portals.pem`` and
  ``/etc/ssl/private/ivozprovider-portals.key``). If ``tls_cert`` and ``tls_key``
  are empty it serves plain HTTP, which is only meant for testing: behind a proxy,
  the authentication failure log would show the IP address of the proxy.

- **Single instance**: used nonces are kept in memory, so only one instance of the
  service may be active. In a cluster, pacemaker runs it on the active portals node.
  On a failover, the nonces issued in the last ``nonce_ttl`` seconds (30 by
  default) stop being valid and the client has to request a new one. All nodes
  must share the same ``digest.secret``: as each install generates a random one,
  set the same value on every portals node.

********
Use case
********

A typical exchange from the browser extension:

#. ``POST /challenge`` with the logged-in terminal's ``aor`` → obtain ``nonce`` and
   ``realm``.

#. Compute ``response`` from ``username``, ``realm``, ``password``, ``nonce`` and the
   clicked ``destination``.

#. ``POST /call`` with ``aor``, ``nonce``, ``response`` and ``destination`` → the
   user's terminal rings and, on answer, the destination is dialed. Keep the
   returned ``iden`` to correlate the call later.

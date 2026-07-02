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

   This service is shipped as the ``ivozprovider-click2call`` package and listens
   on its own port (behind a TLS proxy in production). It is independent from the
   ``/api/platform``, ``/api/brand`` and ``/api/provider`` REST APIs.

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
the proxy as the SIP header ``X-Info-Click2Dial-iden``. The proxy stores it as the
call ``IDEN`` for the leg, so it can be correlated with the originating ``/call``
request from CDRs and realtime data.

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
"wrong password": both return ``403``.

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

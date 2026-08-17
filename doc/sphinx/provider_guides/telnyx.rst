.. _telnyx_provider_guide:

******
Telnyx
******

`Telnyx <https://telnyx.com>`_ is a SIP trunking provider with global coverage, offering
both IP-based and registration-based authentication. This guide covers how to configure
Telnyx as a Carrier (outgoing calls) and DDI Provider (incoming calls) in IvozProvider.

Prerequisites
=============

Before starting, ensure the following in your Telnyx Mission Control Portal:

- A SIP Connection is created (Credentials or IP-based authentication).
- Your IvozProvider Proxy Trunks IP addresses are added to the Telnyx IP Authentication allowlist
  (if using IP authentication).
- At least one phone number (DID) is purchased and assigned to your SIP Connection.

Carrier Configuration (Outgoing Calls)
=======================================

1. Log in as **Brand Operator**.
2. Navigate to **Providers > Carriers** and create a new Carrier.
3. Set the following fields:

   Name
       ``Telnyx``

   Numeric Transformation
       Select the appropriate transformation set for your country (e.g., ``Spain e164 to +e164``).

4. Add a **Carrier Server** with these settings:

   SIP Proxy
       ``sip.telnyx.com``

   URI Scheme
       ``sip``

   Transport
       ``udp`` (Telnyx also supports ``tcp`` and ``tls``; use ``tls`` with URI Scheme ``sips``
       for encrypted signalling)

   Requires Authentication
       Enable if using credential-based authentication. Enter the SIP username and password
       from your Telnyx SIP Connection settings.

   Call Origin Header
       ``PAI`` (Telnyx reads the origin from the P-Asserted-Identity header by default)

.. note:: Telnyx supports both UDP (port 5060) and TLS (port 5061). For TLS, set
   SIP Proxy to ``sip.telnyx.com:5061``, URI Scheme to ``sips``, and Transport to ``tls``.


DDI Provider Configuration (Incoming Calls)
============================================

1. Navigate to **Providers > DDI Providers** and create a new DDI Provider.
2. Set the following fields:

   Name
       ``Telnyx``

   Numeric Transformation
       Same transformation set used for the Carrier.

3. Add a **DDI Provider Registration** if using credential-based authentication:

   Username
       Your Telnyx SIP Connection username.

   Domain
       ``sip.telnyx.com``

4. If using IP authentication instead, add a **DDI Provider Address**:

   IP Address
       Telnyx signalling IPs. Consult the
       `Telnyx IP ranges documentation <https://support.telnyx.com/en/articles/4175187-telnyx-sip-signaling-ip-addresses>`_
       for the current list.

   Description
       ``Telnyx Signalling``

5. Create DDIs under **Providers > DDIs**, assigning each Telnyx phone number to this DDI Provider.


Numeric Transformations
=======================

Telnyx sends and expects numbers in E.164 format with a leading ``+`` (e.g., ``+34911234567``).
Ensure your numeric transformation set handles the ``+`` prefix correctly.

If the built-in transformations do not match, create a custom set under
**Settings > Numeric Transformations** following the patterns described in
:ref:`Numeric transformations`.


Verifying the Configuration
===========================

After configuring both the Carrier and DDI Provider:

1. Check the **Carrier Server** status icon. It should turn green once Telnyx responds to
   OPTIONS pings from IvozProvider.
2. Place a test outgoing call through the configured routing to verify the Carrier.
3. Call one of your Telnyx DIDs from an external phone to verify incoming call delivery.
4. Review **Calls > External calls** to confirm CDR generation.

.. tip:: If the Carrier Server status remains red, verify that your Proxy Trunks IP is
   allowlisted in the Telnyx Mission Control Portal and that firewall rules permit
   SIP traffic (UDP/5060 or TLS/5061) to ``sip.telnyx.com``.

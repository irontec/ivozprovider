################
SIP Antiflooding
################

Both SIP Proxies included in IvozProvider installation, KamUsers for SIP signalling with clients and KamTrunks for SIP
signalling with providers, use `PIKE module <http://kamailio.org/docs/modules/5.1.x/modules/pike.html>`_ to avoid DoS
attacks.

This module keeps trace of all incoming initial request's IP source and blocks the ones that exceed the limit on a given time
interval.

.. warning:: **IPs are not blocked permanently**, they are blocked for 5 minutes. After this time, they are allowed again
             as long as their incoming request rate don't exceed the limit.

.. tip:: :ref:`Antiflood banned IPs` shows a list of addresses that have been banned at some point.

Current configuration parameters are:

- **Sampling time interval**: 2 seconds.

- **Threshold per time unit**: 30 requests.


This means that *any IP address that sends more than 30 requests in a 2-second-time-interval will be blocked (ignored)
for 5 minutes. After this time, they will be unblocked and their request rate will be evaluated again*.

Antiflooding excluded sources
=============================

These sources are not evaluated against antiflood:

- Both KamUsers and KamTrunks:
    - IvozProvider components
    - IPs in :ref:`Antiflood trusted IPs`

- KamUsers:
    - IPs in :ref:`Clients authorized IPs <client_authorized_ip_ranges>` (vPBX, retail, residential)
    - Wholesale clients' IP addresses

.. warning:: IPs and ranges added in :ref:`Clients authorized IPs <client_authorized_ip_ranges>` will be excluded from
         antiflood, even if **Filter by IP address** is disabled.

- KamTrunks:
    - DDI Providers' IP addresses

.. tip:: On a typical NAT scenario with hundreds of UACs sharing the same public IP address, this IP should be static and
         should be added to :ref:`Clients authorized IPs <client_authorized_ip_ranges>` list to avoid been blocked by
         antiflooding (e.g. after lights out, etc.)
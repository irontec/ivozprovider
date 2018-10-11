.. _antiflood_trusted_ips:

*********************
Antiflood trusted IPs
*********************

IvozProvider comes with an *anti-flooding* mechanism to avoid that a single
sender can deny the platform service by sending lots of requests. Both *proxies*
(users and trunks) use this mechanism, that **limits the number of requests
from an origin address in a time lapse**.

.. warning:: When an origin reaches this limit, the proxy will stop sending
    responses for a period of time. After this time, the requests will be again
    handled normally.

Some origins are automatically excluded from this *anti-flooding* mechanism:

- Application Servers from the platform.

- Client authorized IP addresses or ranges (see previous section).

Global operator of the platform can also add exceptions to this mechanism in
the section **Global configuration** > **Antiflood trusted IPs**.
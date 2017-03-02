#################
Security elements
#################

********
Firewall
********

**IvozProvider does not currently include a firewall** but...

.. danger:: We **strongly encourage any production installation to implement
              a firewall** to protect the platform from the wild Internet.

The protection method could be:

- Local firewall based on `iptables <https://www.netfilter.org/>`_

- External firewall

- Both

Exposed ports/services
----------------------

These are the **ports IvozProvider needs to expose** to work properly:

**SIP signalling**:

- Port 5060 (TCP/UDP)

- Port 5061 (TCP)

- Port 7060 (TCP/UDP) y 7061 TCP (just in case both ProxyUsers and ProxyTrunks share IP)

**RTP audioflow**:

- Port range 13000-19000 UDP

**Web portal and provisioning**:

- Ports TCP 443, 1443 y 2443

.. hint:: We recommend using **iptables geoIP module** to drop connections from
          countries where we don't have any users.


****************************
Authorized company IP ranges
****************************

During the Company creating process, we skipped the security mechanism that
**limits the IP addresses or ranges that the company terminals can use 
in their terminals**. 

This can be activated in the section **Brand configuration** > **Company**:

.. image:: img/authorized_ips2.png
    :align: center

Rest of the users won't be allowed to connect from another network, even if the
credentials are valid. 

.. warning:: Once the filter has been activated you **MUST** add networks or 
   valid IP addresses, otherwise, all the calls will be rejected.

.. image:: img/authorized_ips.png

Both IP addresses or ranges can be used, in CIDR format (IP/mask):

.. image:: img/authorized_ips3.png

.. important:: This mechanism limits the origin of the users of a company, it 
   doesn't filter origin from **Contract Peerings**.

*************
Anti-flooding
*************

IvozProvider comes with an *anti-flooding* mechanism to avoid that a single 
sender can deny the platform service by sending lots of requests. Both *proxies*
(users and trunks) use this mechanism, that **limits the number of requests 
from an origin address in a time lapse**.

.. warning:: When an origin reaches this limit, the proxy will stop sending
   responses for a period of time. After this time, the requests will be again
   handled normally.

Some origins are automatically excluded from this *anti-flooding* mechanism:

- Application Servers from the platform.

- Company authorized IP addresses or ranges (see previous section).

Global operator of the platform can also add exceptions to this mechanism in 
the section **Global configuration** > **Antiflood trusted IPs**.

.. image:: img/trusted_ips.png

*********************
Concurrent call limit
*********************

Another security mechanism can avoid that compromised credentials are used to
establish hundreds of calls in little time. This mechanism **limits the number 
of external calls** of each company. 

.. note:: This mechanism only takes into account the external channels, both
   incoming or outgoing external calls.

This can be configured in the company edit screen:

.. image:: img/call_limit.png
    :align: center

.. tip:: To disable this mechanism, set its value to 0.

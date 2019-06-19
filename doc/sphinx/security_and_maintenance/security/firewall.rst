########
Firewall
########

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
          countries where we don't have any clients.

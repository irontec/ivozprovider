# Upgrading Instructions

## Fix SIP binding address in asterisk 13.17.0 for standalone

This is only required in standalone installations or setups where application
servers and proxies live in the same box.

Since 1.6.0 asterisk SIP binding address is set to media relay IP. This changes
must be updated in pjsip.conf and ApplicationServers table (using the global
administration portal).

You can also auto-update this values by simply running:

dpkg-reconfigure ivozprovider

and restarting all services without modifying anything.


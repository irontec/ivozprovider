Providers SIP proxy
-------------------

This is the SIP proxy exposed to the external world in charge of connecting
the provider that brand aministrators will configure for *peering*.

The value displayed in the section **Proxy trunk** will show the IP address
entered during the installation process.

.. ifconfig:: language == 'en'

    .. image:: img/en/proxytrunks.png

.. ifconfig:: language == 'es'

    .. image:: img/es/proxytrunks.png

.. note:: Only the IP address will be entered as the port will be always 5060
    (5061 for SIP over TLS).

.. danger:: This 2 values can be changed from the portal, but they must always
    have the same IP address that proxy process listen to requests.
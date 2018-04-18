************
Peer Servers
************

A **Peer Server** is a SIP server associated to an IP Provider.
In order to add some Peer Servers for the Peer Contract that
have just created, we only have to use the following section:

.. ifconfig:: language == 'en'

    .. image:: img/en/peerservers.png
      :align: center

.. ifconfig:: language == 'es'

    .. image:: img/es/peerservers.png
      :align: center

As displayed by the zero counter, no Peer Serve has been created yet:

.. ifconfig:: language == 'en'

    .. image:: img/en/peerservers_add.png
      :align: center

.. ifconfig:: language == 'es'

    .. image:: img/es/peerservers_add.png
      :align: center

.. glossary::

    Name
        Used to identify this Peer Server

    Description
        Optional field with any required extra information.

    SIP Proxy
        IP address (or DNS registry) of the Peer Server. You can also specify
        a port if it's different from 5060.

    URI Scheme
        Supported schemes are sip and sips. Use 'sip' in case of doubt.

    Transport
        Supported transport protocols. Use 'udp' in case of doubt.

    Outbound Proxy
        Usually this is left empty. It can be filled with the IP address of the
        **SIP Proxy** domain (to avoid DNS resolution, but keeping the domain
        in the SIP messages). It works like a web proxy: instead of sending the
        SIP messages to destination **SIP Proxy**, they will be sent to the
        IP:PORT of this field.

    Requires Authentication
        Some Peering contracts validate our platform by IP, others require
        each session that we want to establish. For this last case, this section
        allows to configure user and password for this authentication.

    Call Origin Header
        Some Providers get origin from SIP From header. Others use the From
        header for accounting and need extra headers to identify the origin.
        In case of doubt leave **PAI** checked.

    R-URI Transformations before numeric transformations
        This setting allow static changes to the destination of the calls before
        applying numeric transformation rules mentioned in
        :ref:`Numeric Transformations`. Some digits can be stripped from the
        begining, add a prefix, or even, add extra parameters to the URI
        followinging the given format. In case of doubt, leave empty.

    From header customization
        For those providers that show origin in other headers (PAI/RPID), it is
        possible that request that From User have the account code being used
        and from domain their SIP domain. In case of doubt, leave empty.

.. tip:: There are many fields to establish *peering* with multiple kind of
   providers, but usually with the name and SIP Proxy will be enough (for
   those that validate our platform by IP) and Authentication (for those that
   won't).

.. warning:: In case of defining multiple Peering Servers for a single
   Peering Contract, IvozProvider will balance and failover using all of them.
   Like with Application Servers, it will disable those who doesn't respond to
   our requests.
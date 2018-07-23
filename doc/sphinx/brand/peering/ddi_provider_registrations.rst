**************************
DDI Provider Registrations
**************************

Some providers require a `SIP Register
<https://tools.ietf.org/html/rfc3261#section-10>`_ active in order to receive
incoming calls to our DDIs. Some of them, even require this register in order
to process our outgoing calls through their services.

.. note:: IvozProvider supports any kind of *peering*, but we highly recomend
   *peer to peer peerings*: without authentication, without registry and
   validated by IP. This will avoid unnecessary traffic (authentication in each
   session and preriodic registers) and simplifies its configuration, just by
   leaving most of the fields by default.

.. glossary::

    Username
        Account number or similar provider by the provider that requires SIP
        register.

    Domain
        Domain or IP of the registar server. Usually the same as the SIP proxy
        of the Peer server.

    DDI
        This will be sent in the SIP Contact header and must be unique in all
        the platform. For DDI Providers with an associated DDI, it is
        recommended to enter that DDI. In case of multiples DDI for the same
        DDI Provider, use any of them. If no DDI is associated with this
        DDI Provider just enter an unique numeric value.

    User
        Authentication user. Most of the time it's the same as username, so
        it's recommended to leave empty.

    Register server URI
        Usually this can be left empty, as it can be obtained from the
        Domain. If it is not the case, enter the IP address with the 'sip:'
        prefix.

    Realm
        Leave empty to accept the authentication realm proposed by the provider.
        Define only if you are familiar to the authentication mechanism used
        in SIP.

    Expire
        Default suggested register expire time.

.. tip:: Similar to the Peer Servers, there are lots of fields in the screen.
   You must have into account that most of the provider doesn't require register
   , and those who does, will only use user, domain and password.

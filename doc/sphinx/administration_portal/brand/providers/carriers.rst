.. _carriers:

********
Carriers
********

Carriers are used to place external outgoing calls.

This are the fields that define a carrier:

.. hint:: Some fields described below may not be visible depending on enabled features.

.. glossary::

    Name
        Used to reference this Carrier.

    Description
        Optional field with any required extra information.

    Numeric Transformation
        Transformation that will be applied to the origin and destination of the
        outgoing numbers that use this Carrier
        (see :ref:`Numeric transformations`).

    Externally rated
        This setting requires the external tarification module and allows
        tarification on special numbers. This module is not standard so don't
        hesitate in :ref:`contact us <getting_help>` if you are interested.

    Calculate cost
        If set, IvozProvider will calculate the cost of the call using the carrier's active rating profile.

    Currency
        Chosen currency will be used in cost calculation, balance movements and
        remaining money operations of this carrier.

.. note:: If "Calculate cost" is enabled, a balance is attached to each carrier. Whenever a carrier
          is used to place a call, this balance will be decreased using carrier's active rating profile.

.. important:: Opposed to clients' balances, carriers' (negative/zero) balances won't disable the carrier.

Carrier Servers
***************

A **Carrier Server** is a SIP server associated to an IP Provider. Carrier servers
are used for placing outgoing calls by using :ref:`Outgoing routings`.

.. glossary::

    SIP Proxy
        IP address (or DNS registry) of the Carrier Server. You can also specify
        a port if it's different from 5060.

    Outbound Proxy
        Usually this is left empty. It can be filled with the IP address of the
        **SIP Proxy** domain (to avoid DNS resolution, but keeping the domain
        in the SIP messages). It works like a web proxy: instead of sending the
        SIP messages to destination **SIP Proxy**, they will be sent to the
        IP:PORT of this field.

    URI Scheme
        Supported schemes are sip and sips. Use 'sip' in case of doubt.

    Transport
        Supported transport protocols. Use 'udp' in case of doubt.

    Requires Authentication
        Some Carriers validate our platform by IP, others require
        each session that we want to establish. For this last case, this section
        allows to configure user and password for this authentication.

    Call Origin Header
        Some Providers get origin from SIP From header. Others use the From
        header for accounting and need extra headers to identify the origin.
        In case of doubt leave **PAI** checked.

    From header customization
        For those providers that show origin in other headers (PAI/RPID), it is
        possible that request that From User have the account code being used
        and from domain their SIP domain. In case of doubt, leave empty.

.. tip:: There are many fields to establish *peering* with multiple kind of
   carriers, but usually with the name and SIP Proxy will be enough (for
   those that validate our platform by IP) and Authentication (for those that
   won't).

.. warning:: In case of defining multiple Carrier Servers for a single
   Carrier, IvozProvider will balance and failover using all of them.
   Like with Application Servers, it will disable those who doesn't respond to
   our requests.

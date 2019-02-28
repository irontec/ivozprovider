.. _residential_devices:

###################
Residential devices
###################

Residential Devices are the main routable option in Residential clients.
More or less like :ref:`friends` are to Virtual PBX Clients, devices
contain the required configurable options to provide a SIP connectivity
service with IvozProvider and an external SIP entity.

.. warning:: Although both **Carriers/DDI Providers** and **Residential Devices** are defined by the
             **brand operator**, the former are designed to connect with the public switched telephony network
             while the latter connects the system with our clients' SIP entities.

Types of residential devices
============================

There are 2 main types of SIP endpoints that can use residential with IvozProvider:

- **Direct connection endpoint**: IvozProvider must be able to talk SIP directly with
  this kind of devices by just forwarding the traffic to the proper port of
  the public IP address of the PBX.

- **Endpoint behind NAT**: Not directly reachable. This kind of endpoint must register at
  IvozProvider (just like all the :ref:`Terminals <terminals>` do).

What kind of calls can be routed through a *Residential Device*?
=================================================================

Contrary to Friends, **Residential Devices** have some simplifications and limitations:

    - Residential Devices only route their assigned DDIs
    - Residential Devices only place externals calls to Carriers
    - Residential Devices only receive external calls from DDI Providers

Residential Devices Configuration
=================================

These are the configurable settings of *Residential devices*:

.. glossary::

    Name
        Name of the **residential device**. This name must be unique in the whole brand so 
        it's recommended to use some kind of sequential identifier. This will also be used
        in SIP messages (sent **From User**).

    Description
        Optional. Extra information for this *residential device*.

    Password
        When the *residential device* send requests, IvozProvider will authenticate it using
        this password. Like remaining SIP entities in IvozProvider (except Wholesale) **using password IS MANDATORY**.

    Direct connectivity
        If you choose 'Yes' here, you'll have to fill the protocol, address and
        port where this *residential device* can be contacted.

    Language
        Locutions will be played in this language

    Numeric transformation
        Numeric transformation set that will be applied when communicating with this device.

    Fallback Outgoing DDI
        External calls from this *residential device* will be presented with this DDI, **unless
        the source presented matches a DDI belonging to the residential device**.

    Allowed codec
        Like vPBX terminals, *residential devices* will talk only the selected codec.

    From domain
        Request from IvozProvider to this device will include this domain in
        the From header.

    DDI In
        If set to 'Yes', use endpoint username in R-URI when calling this residential device. If set to 'No', use called
        number instead.

    Max Calls
        Limits the number of concurrent received calls. Set 0 for unlimited calls.

Voicemail settings
==================

Every residential device has a voicemail that can be accessed using voicemail service code defined at brand level.

Call forwarding settings
========================

Apart from unconditional call forwarding to external number through :ref:`External call filters` applied to DDI,
residential devices may have additional call forwarding settings that allow:

- Forwarding to another external number.

- Forwarding to voicemail associated to each residential device.

- Supported forwarding types: unconditional, no-answer, non-registered, busy.

.. warning:: :ref:`External call filters` have precedence over residential devices call forwarding settings.


Asterisk as a residential device
================================

At the other end of a device can be any kind of SIP entity. This section takes
as example an Asterisk PBX system using SIP channel driver that wants to connect
to IvozProvider.

Device register
----------------

If the system can not be directly access, Asterisk will have to register in the
platform (like a terminal will do).

Configuration will be something like this:

.. code-block:: none

    register => device-name:device-password@ivozprovider-brand.sip-domain.com

Device peer
------------

.. code-block:: none

    [name-peer]
    type=peer
    host=ivozprovider-brand.sip-domain.com
    context=XXXXXX
    disallow=all
    allow=alaw
    defaultuser=device-name
    secret=device-password
    fromdomain=ivozprovider-brand.sip-domain.com
    insecure=port,invite
    sendrpid=pai

.. warning:: *Residential devices* MUST NOT challenge IvozProvider. That's
             why the *insecure* setting is used here.

.. note:: As from username is used to identify the retail account, P-Asserted-Identity must be used to specify caller number.



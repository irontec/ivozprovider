.. _residential_devices:

###################
Residential Devices
###################

Residential Devices are the main routable option in Retail clients.
More or less like :ref:`friends` are to Virtual PBX Companies, accounts 
contain the required configurable options to provide a SIP connectivity
service with IvozProvider and an external SIP entity.

.. warning:: Although both **Contract peering** and **Retail accounts** are defined by the
             **brand operator**, the first ones are designed to connect with the public network
             while the second ones connect the system with other SIP agents.

Types of residential devices
============================

There are 2 main types of SIP PBX that can use residential with IvozProvider:

- **Direct connection PBX**: IvozProvider must be able to talk SIP directly with
  this kind of accounts by just redirecting the traffic to the proper port of
  the public IP address of the PBX.

- **PBX behind NAT**: Not directly accesible. This kind of PBX must register at
  IvozProvider (just like all the :ref:`Terminals <terminals>` do).

What kind of calls can be routed through a *Residential Devices*?
=================================================================

Contrary to Friends, **Residential Devices** have some simplifications and limitations.

    - Residential Devices only route their assigned DDIs
    - Residential Devices only place externals calls to Contract Peerings
    - Residential Devices only receive external calls from Contract Peerings

Residential Devices Configuration
=================================

These are the configurable settings of *Retail accounts*:

.. glossary::

    Name
        Name of the **residential device**. This name must be unique in the whole brand so 
        it's recommended to use some kind of secuential identifier. This will also be used
        in SIP messages (sent **From User**).

    Description
        Optional. Extra information for this *residential device*.

    Password
        When the *residential device* send requests, IvozProvider will authenticate it using
        this password. Like in other SIP agents in IvozProvider **using password IS A MUST**.

    Direct connection
        If you choose 'Yes' here, you'll have to fill the protocol, address and
        port where this *residential device* can be contacted.

    Fallback Outgoing DDI
        External calls from this *residential device* will be presented with this DDI, **unless
        the source presented matches a DDI belonging to the account**.

    Country and Area code
        Used for number transformation from and to this residential device.

    Allowed codecs
        Like a other SIP entities, *residential devices* will talk the selected codec.

    From domain
        Request from IvozProvider to this account will include this domain in
        the From header.


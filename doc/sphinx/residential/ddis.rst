.. _residential_ddis:

################
Residential DDIs
################

DDIs are the external entry point from Contract Peerings to Residential Clients that
can be routed through Residential Accounts.

We can assign an **external call filter** configured in :ref:`previous section
<residential_filters>`. Contrary to Virtual PBX External Call fiters, Residential DDIs
filters only allow static redirection to another external number.

**********************
Residential DDI routes
**********************

Residential DDIs can only be routed to a :ref:`Residential Devices <residential_devices>`
or :ref:`Virtual Fax <faxing_system>`.

.. hint:: Routing a DDI through a Residential device will allow to place external calls
    from that device presenting that DDI as origin.

**********************
Residential Recordings
**********************

If Residential Client has *Recordings* feature enabled, DDIs can also record incoming and/or 
outgoing calls.

Once we have an agreement with a VoIP provider and we have configured it in
the *peering* section, only two task are pending:

.. _settingup_ddi:

###########################
Configuring an external DDI
###########################

The brand operator, responsible of this *peering* agreements with VoIP providers
, has the task to create the DDIs for each provider.

Notice that in order to access this section, the brand operator (or *god*)
must have emulated the proper company and access the menu section **Company
Configuration**.

.. attention:: Section **Company configuration > DDIs** is different when the
   company administrator access than the displayed data when a global or brand
   administrator does. Company administrator are unable to create or delete
   DDIs, just edit the one created by the brand or god administrator.

The section **Brand configuration > DDIs** is a *read-only* display of all the
DDIs of the brand, associated with the different companies.

Taking into account this concepts, we create a new DDI and fill the required
fields:

.. ifconfig:: language == 'en'

    .. image:: img/en/ddis_add.png
      :align: center

.. ifconfig:: language == 'es'

    .. image:: img/es/ddis_add.png
      :align: center

.. _bill_inbound:

For detailed information about configuration fields, check :ref:`DDIs` section.

#########################
Configure incoming routes
#########################

In the previous section, we have created the DDI and configure it, but **the
most common procedure** is that the brand operator just create it while the
**company administator**, using the same saction **will configure** it choosing
the correct route (user, huntgroup, etc.), its filters with calendars and so on.

.. note:: At this point, calling the number of the configured DDI will make the
   *Alice* phone ring.

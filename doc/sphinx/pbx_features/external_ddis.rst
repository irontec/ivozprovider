.. _external_ddis:

#############
External DDIs
#############

In the previous section :ref:`settingup_ddi` we described in detail the required
configuration for an external DDI routed to user. This section will go a bit
further and explain the rest of configurable options of DDIs.

********************
DDI external filters
********************

We can assign a **external call filter** configured in :ref:`previous section 
<external_filters>`.

.. image:: img/ddi_edit.png

.. _routing_logics:

**********
DDI routes
**********

Once the call has passed all the checks in the filter (schedules and calendars)
and after the welcome locution has been played (if there is any configured),
we can route the call to the following processes:

- :ref:`users`
- :ref:`huntgroups`
- :ref:`ivrs`
- :ref:`conference_rooms`
- :ref:`conditional_routes`
- :ref:`queues`
- :ref:`friends`



.. hint:: We can also route the DDI to a :ref:`Virtual Fax <faxing_system>`, but
   this is something we will explain in the following block.

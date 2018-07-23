.. _billable_calls:

##############
Billable calls
##############

**Billable calls** sections only list **calls that imply cost**.

.. important:: :ref:`call_registry` sections, on the other hand, show all calls,
   even the ones that do not imply cost, such as internal calls, incoming calls,
   etc.

These lists therefore include the price of each call (once it is calculated). Since
companies are notified about its call's price via invoices issued by **brand operator**,
this section is only available at two levels:

- Main level (god level)

- Brand level

Each entry shows this information:

.. glossary::

    Date
        Date and time of the call establishment.

    Brand
        Only visible for *god*, shows the brand of each call.

    Company
        Visible for *god* and *brand operator*, show the company of each call.

    Destination
        External number dialed.

    Duration
        Shows how long the call lasted.

    Price
        The cost of the call.

    DDI Provider
        Shows which :ref:`DDI Provider <ddi_provider>` was used for
        each call.

    Invoice
        Show if a call is already included in any :ref:`Invoices`.

.. note:: As soon as the call is hung up, they appear in this list. In some minutes
   time the asynchronous process will set *Metered* to 'yes' and will assign a
   **price**.

.. _wholesale_clients:

*********
Wholesale
*********

Wholesale allows trunking services with Carriers without any application server features,
focusing on concurrency and quality rather on having lots of services.


    - Just make outgoing calls.

    - IP authentication only (no register, no SIP auth).

    - Calls go directly from users to trunks, without any application server involved.

    - Support for routing tags (client can choose the outgoing route to use)

.. hint:: Some fields described below may not be visible depending on enabled features.

.. glossary::

    Name
        Sets the name for this client.

    Features
        Allow configuration of avaialble features for this client.
        Related sections are hidden consequently and the client cannot use them.

    Billing method
        When billing feature is enabled determines when calls will be priced. See :ref:`Billing` section.

    Geographic Configuration
        General client configuration for language and timezones. Most of the settings in the section can be
        configured per user if required.

    Security
        Limits the external concurrent calls.

    Routing tags
        Select the :ref:`routing tags` this wholesale will be able to use.

    Invoice data
        Data included in invoices created by this brand.

    Notifications
        Configure the email :ref:`notification templates` to use for this company.

    Media relay set
        As mentioned above, media-relay can be grouped in sets to reserve capacities
        or on a geographical purpose. This section lets you assign them to companies.

    Audio transcoding
        Select the codec capabilities to add to calls.






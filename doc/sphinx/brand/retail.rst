.. _retail_clients:

******
Retail
******

Retail are designed to provider DDI routing service to clients with self hosted PBXs..

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
        Limits the external concurrent calls and source of calls for this client.

    Invoice data
        Data included in invoices created by this brand.

    Externally rated options
        For :ref:`Carriers` with externally rated enabled, this field can be used to store specific
        information for this client.

    Notifications
        Configure the email :ref:`notification templates` to use for this company.

    Outgoing DDI
        Selects a DDI for outgoing calls of this client, if it is no overridden in
        a lower level.

    Media relay set
        As mentioned above, media-relay can be grouped in sets to reserve capacities
        or on a geographical purpose. This section lets you assign them to companies.

    Distribute Method
        'Hash based' distributes calls hashing a parameter that is unique per
        client, 'Round robin' distributes calls equally between AS-es and
        'static' is used for debugging purposes.

    Application Server
        If 'static' *distribute method* is used, select an application server here.

    Recordings
        Configures a limit for the size of recordings of this client. A
        notification is sent to configured address when 80% is reached and
        older recordings are rotated when configured size is reached.

.. hint:: Retail clients and their accounts use Brand's domain for authentication.

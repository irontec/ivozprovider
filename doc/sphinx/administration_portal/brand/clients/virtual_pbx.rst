***********
Virtual PBX
***********

Virtual PBX clients are designed to provide service to clients with multiple terminals
that require feature-full call flows.

.. hint:: Some fields described below may not be visible depending on enabled features.

.. glossary::

    Name
        Sets the name for this client.

    SIP domain
        DNS for this client. See :ref:`Client SIP Domain` section.

    Features
        Allow configuration of available features for this client.
        Related sections are hidden consequently and the client cannot use them.

    Billing method
        When billing feature is enabled determines when calls will be priced. See :ref:`Billing` section.

    Geographic Configuration
        General client configuration for language and timezones. Most of the settings in the section can be
        configured per user if required.

    Currency
        Chosen currency will be used in price calculation, invoices, balance movements and
        remaining money operations of this client.

    Security
        Limits the external concurrent calls and source of calls for this client.

    Invoice data
        Data included in invoices created by this brand. This section also allows displaying invoices list in
        client's portal menu so they can download them.

    Externally rated options
        For :ref:`Carriers` with externally rated enabled, this field can be used to store specific
        information for this client.

    Notifications
        Configure the email :ref:`notification templates` to use for this client.

    Outgoing DDI
        Selects a DDI for outgoing calls of this client, if it is no overridden in
        a lower level.

    Media relay set
        As mentioned above, media-relay can be grouped in sets to reserve capacities
        or on a geographical purpose. This section lets you assign them to clients.

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


Most of the features are self-explanatory, but **voice notification** deserves
an explanation: if you enable them, when a call fails, the user will listen a
locution explaining what occurred ("you have no permissions to place this call",
"the call cannot be billed", etc.)

.. warning:: Recordings rotation happens at two levels: brand and client. This
              means that **a client's recordings can be rotated even though its limit
              has not arrived (or even it has no limit) if brand's limit applies first**.

.. error:: Again: recordings rotation happens at two levels: brand and client. This
              means that **a client's recordings can be rotated even though its limit
              has not arrived (or even it has no limit) if brand's limit applies first**.

.. hint:: To avoid this, make sure that the sum of all clients does not exceed
          the size assigned to your brand and make sure that all clients has
          a size configured (if 0, it has unlimited size).

Both **Distribute method** and **Application Server** are only visible for God
Administrator.

.. warning:: 'Round-robin' distribute method is reserved for huge clients
              whose calls cannot be handled in a single AS. **Use 'Hash based'
              for remaining ones**, as 'Round-robin' imposes some limitations
              to client features (no queues, no conferences).




.. _retail_clients:

******
Retail
******

Retail clients are even a more lightweight client type than *Residential clients*.

They just provide a SIP trunking service that include these features:

- Configure one or more retail accounts (SIP devices).
- Setup one or more DDIs.
- **Place external calls** showing one of those DDIs.
- **Receive external calls** to their DDIs.
- Record calls.

.. warning:: No users, no extensions, no internal calls, no hunt groups, no IVRs, no voicemail...
             just **incoming and outgoing external calls**.

.. error:: Retail clients and their accounts **MUST use Brand's SIP domain in their SIP messages**.

Differences between retail and residential clients
--------------------------------------------------

There is an important key difference between these two clients: **retail client calls do not traverse
any application server**.

As a result:

- No virtual faxing service for retail clients.

- No voicemail service for retail clients.

But they also have benefits that make them ideal for some situations:

- No application server traverse, much less load for the platform.

- Call transcoding as a feature.

- Routing tags for different call routing for same destinations.

.. warning:: Residential devices are force to talk the codec selected in their configuration (just one).
             Retail clients, on the other hand, can talk in the codecs they offer in their SDP and in the
             codecs selected in IvozProvider: IvozProvider will make transcoding when necessary.

.. tip:: Use retail client type unless you need any of the services provided by application servers (fax or voicemails).

Adding/Editing retail clients
-----------------------------

.. hint:: Some fields described below may not be visible depending on enabled features.

These are the fields shown when **adding** a new retail client:

.. glossary::
    :sorted:

    Name
        Used to reference this particular client.

    Billing method
        To choose among postpaid, prepaid and pseudo-prepaid.

    Language
        Used to choose the language of played locutions.

    Country code
        Default country code for DDIs.

    Default timezone
        Used for showing call registries dates.

    Currency
        Chosen currency will be used in price calculation, invoices, balance movements and
        remaining money operations of this client.

    Numeric transformation
        Describes the way the client will "talk" and the way the client wants to be "talked".

    Max calls
        Limits both client generated and external received calls to this value (0 for unlimited). Setting to 2 will allow
        setting 2 outgoing calls and received 2 incoming calls (in parallel).

    Filter by IP address
        If set, the platform will only allow calls coming from allowed IP addresses or network ranges.

When **editing** a client, these additional fields can be configured:

.. glossary::
    :sorted:

    Invoice data
        All the fields in this group will be included in invoices generated for this client. This section also allows
        displaying invoices list in client's portal menu so they can download them.

    Externally rater custom options
        This field is for setting options for an optional external rating module.

    Outgoing DDI
        Fallback DDI for external outgoing calls (can be overridden at residential device level).

    Routing tags
        This field allows enabling routing tags for this specific client. Call preceded with this
        routing tags will be rated and routed differently.

    Audio transcoding
        This field allows enabling codecs for this specific client. This codecs will be added to
        the ones offered by the client in its SDP.


.. note:: Apart from these fields, main operator (*aka* God) will also see a **Platform data** group that allows:

    - Choosing an specific media relay set for the client.

.. tip:: For outgoing calls, platform will use the CLID provided by the client as long as it is considered valid, otherwise fallback DDI
         will be used. The platform will consider as valid any CLID that matches one of the client's DDIs.

Additional subsections
----------------------

Each entry in this table has these additional options:

- **List of authorized sources**: if *Filter by IP address* is enabled, this subsection allows adding addresses or network ranges.

.. error:: No outgoing call will be allowed if *Filter by IP address* is enabled and the corresponding list is empty.

- **List of client admins**: this subsection allows managing portal credentials for this specific client.

- **List of Rating profiles**: this subsection allows managing the rating profiles that will be used to bill its outgoing calls.

.. warning:: No outgoing call will be allowed for this client unless an active rating profiles that can
             bill the specific call.

- **List of Outgoing routes**: this subsections shows routing rules that apply only for this client.

.. tip:: As *Apply all clients* routing rules also will apply for this client, the recommended way to manage routes is
         using **Outgoing routings** section instead.

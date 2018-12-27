***********
Residential
***********

Residential clients are a more lightweight client type than *vPBX clients*.

Their target is to provide these services to residential environments:

- Configure one or more residential devices (SIP devices).
- Setup one or more DDIs.
- **Place external calls** showing one of those DDIs.
- **Receive external calls** to their DDIs.
- Send/Receive virtual faxes.
- Record calls.

.. warning:: No users, no extensions, no internal calls, no hunt groups, no IVRs... just **incoming and outgoing external
        calls (and a few voice services)**.

.. error:: Residential clients and their devices **MUST use Brand's SIP domain in their SIP messages**.

Adding/Editing residential clients
----------------------------------

.. hint:: Some fields described below may not be visible depending on enabled features.

These are the fields shown when **adding** a new residential client:

.. glossary::
    :sorted:

    Name
        Used to reference this particular client.

    Billing method
        To choose among postpaid, prepaid and pseudo-prepaid.

    Features
        Enable/Disable faxing and call recording for this particular client.

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

    Recordings
        This group allows choosing an on-demand method or disabling this feature and the code used to enable it on call.

    Notification options
        This group allows choosing a notification template for both faxes and voicemail notifications.

.. note:: Apart from these fields, main operator (*aka* God) will also see a **Platform data** group that allows:

    - Choosing an specific media relay set for the client.

    - Choose the way that calls of this client will be distributed among existing application servers (**hash based** is recommended).

.. tip:: For outgoing calls, platform will use the CLID provided by the client as long as it is considered valid, otherwise fallback DDI
         will be used. The platform will consider as valid any CLID that matches one of the client's DDIs.

Additional subsections
----------------------

Each entry in this table has these additional options:

- **List of authorized sources**: if *Filter by IP address* is enabled, this subsection allows adding addresses or network ranges.

.. error:: No outgoing call will be allowed if *Filter by IP address* is enabled and the corresponding list is empty.

- **List of client admins**: this subsection allows managing portal credentials for this specific client.

- **List of rating profiles**: this subsection allows managing the rating profiles that will be used to bill its outgoing calls.

.. warning:: No outgoing call will be allowed for this client unless an active rating profiles that can
             bill the specific call.

- **List of Outgoing routes**: this subsections shows routing rules that apply only for this client.

.. tip:: As *Apply all clients* routing rules also will apply for this client, the recommended way to manage routes is
         using **Outgoing routings** section instead.

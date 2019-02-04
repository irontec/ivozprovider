.. _wholesale_clients:

*********
Wholesale
*********

Wholesale clients are the simplest client type in IvozProvider.

It allows trunking services with Carriers without any application server features,
focusing on concurrency and quality rather on having lots of services.


    - Just make outgoing calls.

    - IP authentication only (no register, no SIP auth).

    - Calls go directly from users to trunks, without any application server involved.

    - Support for routing tags (client can choose the outgoing route to use)

    - Support for audio transcoding.

.. warning:: No users, no extensions, no internal calls, no DDIs, no voicemail, no call forwards...
    just **outgoing external calls**.

.. error:: Wholesale clients **do not need to use Brand's SIP domain in their SIP messages**.

Adding/Editing clients
----------------------

.. hint:: Some fields described below may not be visible depending on enabled features.

These are the fields shown when **adding** a new wholesale client:

.. glossary::
    :sorted:

    Name
        Used to reference this particular client.

    Billing method
        To choose among postpaid, prepaid and pseudo-prepaid.

    Language
        Used to choose the language of played locutions.

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


When **editing** a client, these additional fields can be configured:

.. glossary::
    :sorted:

    Invoice data
        All the fields in this group will be included in invoices generated for this client. This section also allows
        displaying invoices list in client's portal menu so they can download them.

    Externally rater custom options
        This field is for setting options for an optional external rating module.

    Routing tags
        This field allows enabling routing tags for this specific client. Call preceded with this
        routing tags will be rated and routed differently.

    Audio transcoding
        This field allows enabling codecs for this specific client. This codecs will be added to
        the ones offered by the client in its SDP.

.. note:: Apart from these fields, main operator (*aka* God) will also see a **Platform data** group that allows:

    - Choosing an specific media relay set for the client.

Additional subsections
----------------------

Each entry in this table has these additional options:

- **List of authorized sources**: client identification will be made looking up the source IP address in this table.

- **List of client admins**: this subsection allows managing portal credentials for this specific client.

- **List of rating profiles**: this subsection allows managing the rating profiles that will be used to bill its outgoing calls.

.. warning:: No outgoing call will be allowed for this client unless an active rating profiles that can
             bill the specific call.

- **List of Outgoing routes**: this subsections shows routing rules that apply only for this client.

.. tip:: As *Apply all clients* routing rules also will apply for this client, the recommended way to manage routes is
         using **Outgoing routings** section instead.

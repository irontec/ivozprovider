.. _virtual pbx:

***********
Virtual PBX
***********

Virtual PBX clients are designed to provide service to clients with multiple terminals
that require feature-full call flows.

.. hint:: Some fields described below may not be visible depending on enabled features.

    Name
        Sets the name for this client.

    SIP domain
        DNS for this client. See :ref:`Client SIP Domain` section.

    Features
        Allow configuration of available features for this client.
        Related sections are hidden consequently and the client cannot use them.

    Billing method
        When billing feature is enabled determines when calls will be priced. 'none' disables billing.
        See :ref:`Billing` section.

    Corporation
        Select which corporation this client belongs to. Enables using :ref:`Inter VPBX friends <internal_friends>` to
        dial other client extensions.

    Geographic Configuration
        General client configuration for language and timezones. Most of the settings in the section can be
        configured per user if required.

    Currency
        Chosen currency will be used in price calculation, invoices, balance movements and
        remaining money operations of this client.

    Max calls
        Limits both incoming and outgoing external calls (0 for unlimited).

    Filter by IP address
        If set, the platform will only allow calls coming from allowed IP/ranges or countries.

    GeoIP allowed countries
        If *Filter by IP address* is enabled, traffic from selected countries will be allowed.

    Max daily usage
        Limits external outbound calls when this limit is reached within a day. At midnight counters are reset and
        accounts are re-enabled.

    Email
        A notification email will be sent to given address when configured max daily usage is reached. Leave empty to
        avoid notification.

    Invoice data
        Data included in invoices created by this brand. This section also allows showing/hiding billing details to
        client's portal, such as Invoices, Rating Profiles and Price of external calls.

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

    On-demand call recording
        Shown only if *Recording* feature is enabled for client, allows enabling and
        disabling on-demand call recording. If enabled, you can choose how to invoke
        and service code if needed.

    Allow Client to remove recordings
        Shown only if *Recording* feature is enabled for client, shows/hides recording
        removal button on client *Call Recordings* section.


Most of the features are self-explanatory, but **voice notification** deserves
an explanation: if you enable them, when a call fails, the user will listen a
locution explaining what occurred ("you have no permissions to place this call",
"the call cannot be billed", etc.)

Both **Distribute method** and **Application Server** are only visible for God
Administrator.

.. warning:: 'Round-robin' distribute method is reserved for huge clients
              whose calls cannot be handled in a single AS. **Use 'Hash based'
              for remaining ones**, as 'Round-robin' imposes some limitations
              to client features (no queues, no conferences).

Additional subsections
----------------------

Each entry in this table has these additional options:

- **List of authorized sources**: if *Filter by IP address* is enabled, this subsection allows adding addresses or network ranges.

.. error:: No outgoing call will be allowed if *Filter by IP address* is enabled and the corresponding list is empty.

- **List of client admins**: this subsection allows managing portal credentials for this specific client. Read :ref:`acls`
  for further explanation about restricted client administrators.

- **List of Rating profiles**: this subsection allows managing the rating profiles that will be used to bill its outgoing calls.

.. warning:: No outgoing call will be allowed for this client unless an active rating profiles that can
             bill the specific call.

.. _users mass import:

Users mass import
-----------------

The **Import users** action of each Virtual PBX row creates or updates its users from a
CSV file, together with their terminals, extensions and outgoing DDIs. The dialog
shows the expected format, offers a downloadable template and reports the result
of every line. It is only shown to administrators allowed to import users.

The same operation is available through the brand API, see :ref:`users mass import api`.

CSV format
~~~~~~~~~~

One user per row and eleven columns, in this order *(Fields marked with * are required)*:

    Name*
        First name of the user. Together with the lastname it identifies the user
        within the client: a row with an existing name and lastname updates that user.
    Lastname*
        Last name of the user.
    Email
        Email of the user. It must be unique in the whole platform, so an address
        that belongs to a user of another client fails the row. When no user of the
        client has the given name and lastname, the row updates the user of the
        client that owns the email.
    Terminal name
        Name of the terminal (letters, digits, ``_`` and ``*``). It is created if it
        does not exist and assigned to the user.
    Terminal password
        SIP password of the terminal: at least 10 characters with 3 uppercase, 3
        lowercase, 3 digits and one of ``+ * _ -``. Leave it empty to keep the current
        password of an existing terminal or to generate a random one for a new terminal.
    Terminal model
        Identifier of an existing terminal model, as shown in *Terminal models*
        (for example ``YealinkT21P_E2``).
    MAC
        MAC address of the terminal, 12 hexadecimal characters without separators.
    Extension
        Extension number assigned to the user. It is created if it does not exist.
    DDI country
        ISO code of the DDI country (for example ``ES``). The client country is used
        when empty.
    DDI number
        Number of the outgoing DDI, digits only and without country prefix. It is
        created and routed to the user if it does not exist.
    DDI provider
        Name of a DDI provider of the brand.

Columns can be separated by commas or semicolons and the file may be encoded in
UTF-8, with or without BOM, or in Windows-1252. Blank rows are ignored and a first
row with the column names (``name,lastname,email,...``) is skipped, so the template
can be filled in directly.

.. rubric:: Example CSV file

.. code-block:: none

    Alice,Allison,alice@example.com,alice_t21,Zx9*abc123DEF,YealinkT21P_E2,001565aabbcc,301,ES,944000301,
    Bob,Bobson,bob@example.com,bob_t21,,YealinkT21P_E2,,302,,,
    Carol,Smith,carol@example.com,,,,,,,,

The first row creates the user with its terminal, extension and outgoing DDI. The
second one lets the platform generate the terminal password and creates no DDI.
The third one creates a user without terminal or extension.

Re-importing a file
~~~~~~~~~~~~~~~~~~~

Rows are matched against the existing users of the client by name and lastname,
or by email when none has that name and lastname, so the same file can be
imported again:

- Importing the same file twice changes nothing and creates no duplicates.
- Changing a value and importing again updates only that value.
- Changing the name or lastname of a user while keeping its email renames that
  user.
- Empty columns of an existing user are left untouched: they never remove its
  terminal, extension, DDI or email.
- Terminals are matched by name, or by MAC when the name is new, so a terminal
  can be renamed by keeping its MAC.
- An existing DDI of the client can be the outgoing DDI of several users; its
  inbound routing is not changed.

New users are created inactive: they can use their terminal, but cannot log into
the user portal until an administrator sets their password.

Errors
~~~~~~

Valid rows are imported and the rest are reported with their line number and the
reason. Fix the reported lines and import the file again; the rows already imported
are simply updated.

A row fails, among other reasons, when:

- its name or lastname is empty, or a value has an invalid format;
- its email belongs to a user of another client, or to another user when the
  row already matches a user by name and lastname; its terminal or extension
  already belongs to another user, its MAC belongs to another terminal, its
  extension is routed to a queue or any other element, or its DDI belongs to
  another client or another brand;
- its terminal model, country or DDI provider does not exist.

Some errors affect the whole file and nothing is imported: an empty file, a row
with a wrong number of columns or the same user, email, terminal, MAC, extension
or DDI repeated in several rows. They are reported as line 0.

If the import stops because of an unexpected error, the remaining rows are
reported as *not processed*: import the file again once the problem is solved.

Saving the file from Excel
~~~~~~~~~~~~~~~~~~~~~~~~~~

Use *Save as* and choose **CSV UTF-8 (comma delimited)**; the *CSV (comma delimited)*
format also works. Depending on the regional settings Excel separates the columns
with semicolons, which are accepted as well. Keep the MAC, extension and DDI
columns as text, otherwise Excel may drop leading zeros or rewrite long numbers
in scientific notation.

.. _users mass import api:

Using the API
~~~~~~~~~~~~~

The import is exposed as ``POST /users/mass_import`` in the brand API. It expects a
``multipart/form-data`` request with the ``company`` identifier and the ``csv`` file:

.. code-block:: console

    curl -X POST https://brand.example.com/api/brand/users/mass_import \
        -H "Authorization: Bearer ${TOKEN}" \
        -F company=1 \
        -F csv=@users.csv

The response summarises the import and lists every failed line:

.. code-block:: json

    {
        "created": 2,
        "updated": 0,
        "errors": [
            {
                "line": 2,
                "message": "Email bob@example.com belongs to a user of another client"
            }
        ]
    }

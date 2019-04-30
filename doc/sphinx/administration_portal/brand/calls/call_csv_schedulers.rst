*******************
Call CSV schedulers
*******************

This section allows programming the automatic periodical creation of CSV reports to:

- Clients (no matter type).

- Brand operators.

.. note:: This section is almost identical to :ref:`Invoice schedulers` except to the
          fields that do not apply to CSVs (Invoice number sequence, Tax rate...)

.. tip:: Brand operators can schedule a CSV containing calls of all its clients.
         In this kind of schedules, a notification template can be chosen. In remaining
         schedules, the notification template assigned to the specific client will be used.

When adding a new definition, these fields are shown:

.. glossary::

    Name
        Name of the scheduled Call CSV

    Call direction:
        Which kind of calls should be included: Inbound, outbound or both.

    Client
        Which client calls should be included

    Email
        Send generated Call CSV via email. Empty if no automatic mail is wanted.

    Notification template:
        Used on email notifications

    Frequency/Unit
        Defines the frequency (once a month, every 7 days, etc.) of the programmed task

Once created, some new fields and subsections are accesible:

- Next execution date.
- Last execution date and result (success/error).
- Generated CSVs in **List of Call CSV reports**.

.. tip:: Brand operator can generate CSV containing calls of all clients.

CSV fields
==========

These are the fields of the generated CSV files:

.. glossary::

    callid
        Call-ID of the SIP dialog

    startTime
        Time and date of the call establishment

    duration
        Call duration in seconds

    caller
        Caller number in E.164 format (with '+')

    callee
        Callee number in E.164 format (with '+')

    price
        Calculated price for the given call

    direction
        call direction

In Brand CSVs, these additional fields will be included too:

.. glossary::

    endpointType
        'RetailAccount' for retail clients, empty for remaining types.

    endpointId
        Retail Account ID for retail clients, empty for remaining types.

    cost
        Calculated cost for the given call

    companyId
        Client ID

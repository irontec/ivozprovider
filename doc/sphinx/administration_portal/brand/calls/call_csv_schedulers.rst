*******************
Call CSV schedulers
*******************

This section allows programming the automatic periodical creation of CSV reports to:

- Clients (no matter type).

- Brand operators.

.. note:: This section is identical to :ref:`Invoice schedulers` except to the
          fields that do not apply to CSVs (Invoice number sequence, Tax rate...)

.. tip:: Brand operators can schedule a CSV containing calls of all its clients.
         In this kind of schedules, a notification template can be chosen. In remaining
         schedules, the notification template assigned to the specific client will be used.

Apart from the fields above, everything described in :ref:`Invoice schedulers` applies here:

- Frequency/Unit configuration.
- Email send.
- View generated CSVs in **List of Call CSV reports**.
- Next execution date.
- Last execution date and result (success/error).

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
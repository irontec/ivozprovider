*******************
Call CSV schedulers
*******************

This section allows programming automatic periodical CSV reports to brand operators.

.. note:: This section is almost identical to :ref:`Invoice schedulers` except to the
          fields that do not apply to CSVs (Invoice number sequence, Tax rate...)

When adding a new definition, these fields are shown:

.. glossary::

    Name
        Name of the scheduled Call CSV

    Email
        Send generated Call CSV via email. Empty if no automatic mail is wanted.

    Client type
        Selecting *All* will generate a CSV containing calls of all clients. Selecting one client type
        will allow selecting one specific client of that type.

    Notification template
        Used on email notifications for schedulers containing calls of all clients. In client specific
        schedulers, the notification template assigned to the specific client will be used.

    Frequency/Unit
        Defines the frequency (once a month, every 7 days, etc.) of the programmed task

    Direction
        Defines which calls should be included attending to its direction (inbound, outbound, both).

    Carrier
        Only for *Direction: outbound* reports, allows filtering calls of one specific carrier.

    Client
        Only for *Client type* different from *All*, allows selecting one specific client.

    DDI
        Only for *Client type* different from *All*, allows selecting one specific DDI of chosen client.

    Residential device
        Only for *Client type: residential*, allows selecting one specific residential device of chosen client.

    Retail account
        Only for *Client type: retail*, allows selecting one specific retail account of chosen client.

    User
        Only for *Client type: vpbx*, allows selecting one specific user of chosen client.

    Fax
        Only for *Client type: vpbx*, allows selecting one specific fax of chosen client.

    Friend
        Only for *Client type: vpbx*, allows selecting one specific friend of chosen client.


Once created, some new fields and subsections are accesible:

.. glossary::

    Next execution
        Shows next execution date

    Last execution
        Shows last execution and its result.


.. tip:: Modifying *Next execution* value allows forcing specific runs. For example, setting *Next execution* to
         current month's first day will create again last month's CSV report (for a monthly scheduler).


Generated CSVs of each scheduler can be accessed in **List of Call CSV reports** subsection.


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

    cost
        Calculated cost for the given call

    price
        Calculated price for the given call

    endpointType
        Possible values: RetailAccount, ResidentialDevice, User, Fax, Friend.

    endpointId
        Internal ID of specific endpoint (only when *endpointType* is non-empty).

    direction
        Possible values: inbound, outbound.

    companyId
        Client ID

    carrierId
        Only for outbound calls, internal ID of used carrier

    ddiProviderId
        Only for inbound calls, internal ID of used DDI Provider

    ddiId
        Client DDI to which call will be assigned (callee for inbound calls, caller for outbound calls). Empty for
        wholesale clients.

DDI Provider detection
======================

DDI Provider detection deserves a deeper explanation as is not as unambiguous as Carrier (carrier is the one chosen by
routing logic, no doubt here).

DDI Provider detection logic is directly related to underlying DDI detection logic.

When IvozProvider receives an INVITE to KamTrunks from an outside entity:

#. Source IP is compared against all DDI Providers addresses (from all brands).

    - If none matches, call is rejected.

#. DDI is transformated in a loop using matching DDI Providers transformation rules (the lower id, the first).

#. As soon as transformated DDI matches a DDI (in E.164) within the same brand, loop ends and call is accepted.

    - If loop ends without any match, call is rejected.

The DDI Provider that allowed that match is saved as DDI Provider for that inbound all, except:

- Matched DDI is linked to another DDI Provider that also matches source IP address. If this happens, linked DDI Provider
  is saved instead.

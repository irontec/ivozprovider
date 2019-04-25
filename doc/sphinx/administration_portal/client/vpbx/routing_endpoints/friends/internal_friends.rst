Internal friends
================

Internal friends allows a vPBX client to call to **Extensions** of another vPBX client in the same brand.

.. important:: Only extensions in :ref:`Extensions <extensions>` section.

If calling to an extension in another vPBX causes an external call, it is allowed:

- Calling to a user with an external call forwarding settings.

- Calling to an extension routed to an external number.

- Calling to an extension routed to a IVR with an option pointing an external number.

- Etc.

What kind of calls can be routed through an *internal friend*?
--------------------------------------------------------------

IvozProvider must know what calls must be routed to the different defined *friends* (both internal and remote friends).
For that, **client administrator** will configure regular expressions that
describe the numbers that *can be reached* through the **internal friend**.

.. note:: Internal :ref:`extensions <extensions>` have priority over any expression
          defined in the *friends*.

To sum up, IvozProvider will route a call received by a :ref:`user <users>` or
a :ref:`friend <friends>` following this logic:

1. Destination matches an existing IvozProvider extension?

2. If not: Destination matches any *friend* regular expression?

3. If not: This is an external call.

.. important:: Avoid PCRE regular expressions in friend configuration: use [0-9] instead of \\d.

Configuration of internal friends
---------------------------------

These are the configurable settings of *internal friends*:

.. glossary::

    Description
        Optional. Extra information for this **friend**.

    Priority
        Used to solve conflicts while routing calls through **friends**.
        If a call destination **matches** more than one friend regular expression
        the call will be routed through the friend with **less priority value**.

    Connectivity mode
        Choose "IntervPBX" for internal friends.

    Target Client
        vPBX client inside the same brand you want to connect.

    Fallback Outgoing DDI
        If called extension causes an external call, this DDI will be used as source number.

.. note:: Calls to *friends* are considered internal. That means that ACLs won't
          be checked when calling a friend, no matter if the origin of the call
          is a user or another friend.

Summary of internal friends
---------------------------

These are key points to understand *internal friends*:

- They have been designed to allow users from a vPBX to call to extensions (normally users)
  of another vPBX of the same brand.

- Usually they will allow user-user calls.

- You cannot use an internal friend to generate external calls paid by the other client.

- But external calls may happen if extensions are pointed to external numbers (controlled external calls).

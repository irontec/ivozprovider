############
Call billing
############

Billing a call is the **action of setting a price** to a call that implies cost.

*****************
Automatic billing
*****************

As exposed previously, billing calls depends upon an automatic process:

- When a call is about to be established, IvozProvider verifies that it will be
  able to bill it.

    - If with the current configuration (active and applicable rating plans for
      a given company and for the specific destination) it won't be possible to
      bill the call, IvozProvider will prevent its establishment.

- Once a call that implies cost is hung up, it is listed in :ref:`billable_calls`.


Postpaid billing
================

   - Call tarification is done after the call ends

   - No configurable limit or balances involved


Prepaid billing
================

   - Call trarification is done during the call

   - Clients with prepaid have a preconfigured balance that will be decrement during the call

   - When the balance reaches zero, all established calls for the client will hang up

   - Clients can not place new calls with zero or below balance

   - Low balance email notifications can be configured


Pseudo-prepaid billing
======================

   - Call trarification is done during the call

   - Clients with pseudo-prepaid have a preconfigured balance that will be decrement after the call ends

   - Clients can not place new calls with zero or below balance

   - Low balance email notifications can be configured

.. _vpbx webhooks:

.. include:: ../../../shared/webhooks.rst.inc

**********************
Available placeholders
**********************

These are the placeholders that can be used in the template at client level:

.. list-table::
     :widths: 20 80
     :header-rows: 0

     * - ``{{event}}``
       - Event that triggered the request (start, ring, answer, end, updateClid).
     * - ``{{callId}}``
       - Call-ID of the SIP dialog.
     * - ``{{direction}}``
       - Call direction (inbound/outbound).
     * - ``{{owner}}``
       - Internal endpoint (user, friend, ...) involved in the call.
     * - ``{{party}}``
       - Remaining participant of the call.
     * - ``{{userId}}``
       - Internal ID of the user the webhook belongs to.
     * - ``{{time}}``
       - Event timestamp.
     * - ``{{iden}}``
       - Webhook identifier.

*****************
Assignment level
*****************

In the client portal, webhooks are configured per user (**Webhooks** section of each user) and apply
only to calls involving that user.

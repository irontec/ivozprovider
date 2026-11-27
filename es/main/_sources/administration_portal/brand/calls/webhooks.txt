.. _brand webhooks:

.. include:: ../../shared/webhooks.rst.inc

**********************
Available placeholders
**********************

These are the placeholders that can be used in the template at brand level:

.. list-table::
     :widths: 20 80
     :header-rows: 0

     * - ``{{event}}``
       - Event that triggered the request (start, ring, answer, end, updateClid).
     * - ``{{time}}``
       - Event timestamp.
     * - ``{{callId}}``
       - Call-ID of the SIP dialog.
     * - ``{{companyId}}``
       - Internal ID of the client involved in the call.
     * - ``{{company}}``
       - Name of the client involved in the call.
     * - ``{{ddiId}}``
       - Internal ID of the involved DDI.
     * - ``{{crId}}``
       - Internal ID of the carrier used (outbound calls).
     * - ``{{dpId}}``
       - Internal ID of the DDI provider used (inbound calls).
     * - ``{{direction}}``
       - Call direction (inbound/outbound).
     * - ``{{caller}}``
       - Caller number in E.164.
     * - ``{{callee}}``
       - Callee number in E.164.
     * - ``{{carrier}}``
       - Name of the carrier used (outbound calls).
     * - ``{{ddiProvider}}``
       - Name of the DDI provider used (inbound calls).
     * - ``{{iden}}``
       - Webhook identifier.

*****************
Assignment levels
*****************

Brand operators can define webhooks at two different levels:

    Client level
        Configured in each client configuration (**Webhooks** section). Applies to every call of that
        client, regardless of the DDI involved.

    DDI level
        Configured in a specific DDI. Applies only to calls of that DDI.

.. hint:: The available placeholders and events are the same at both levels; only the scope of matching
          calls changes.

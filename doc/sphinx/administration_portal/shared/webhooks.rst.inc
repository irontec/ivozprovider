
########
Webhooks
########

Webhooks let IvozProvider notify external HTTP services about call events in real time. Whenever a
subscribed event happens on a matching call, IvozProvider sends an HTTP ``POST`` request to the
configured endpoint with a customizable JSON payload.

.. hint:: Webhooks can be enabled per Brand basis via Features.

*******************
Configurable fields
*******************

    Name
        Used to identify this webhook.

    Description
        Optional free text describing the webhook purpose.

    URL
        Endpoint that will receive the HTTP ``POST`` request every time a subscribed event is triggered.

    Direction
        Restricts the webhook to calls of a given direction:

        - **Inbound**: only incoming calls.

        - **Outbound**: only outgoing calls.

        - **Both**: incoming and outgoing calls (default).

******
Events
******

Each webhook subscribes to one or more call events. A ``POST`` request is sent every time a subscribed
event happens on a matching call:

    Start
        Sent when a new call starts.

    Ringing
        Sent when the destination starts ringing.

    Answer
        Sent when the call is answered.

    End
        Sent when the call ends.

    Update CLID
        Sent when the caller line identification (CLID) is updated during the call.

********
Template
********

The body of the ``POST`` request is defined by the **Template** field: a valid JSON document where
``{{placeholder}}`` marks are replaced with the actual call values before the request is sent.

.. hint:: A default template is provided when creating a new webhook. You can adapt it freely as long
          as the result is valid JSON.

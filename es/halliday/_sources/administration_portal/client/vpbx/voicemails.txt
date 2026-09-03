.. _voicemails:

**********
Voicemails
**********

Voicemails can be used as leaf routable endpoint in most vPBX logics.

All users start with a pre-configured voicemail with their email address that can be disabled in voicemails section.

It's also possible to create a Voicemail that is not linked to any user, so it can be used in more global routing
logics.

.. note:: For these generic voicemails, an extension routed to the voicemail is required to access the check voicemail
          service (using the service code followed by the extension number).


Voicemail most notable fields are:


    Enabled
        Enables or disables voicemail. This will hide this voicemail from select listboxes in routes.

    Name
        The name displayed in the selection listboxes. For user voicemails, this value is calculated from Firstname and
        Lastname of the user.

    Locution
        If set, this locution is played as voicemail welcome message when a voicemail
        for this voicemail is going to be recorded. This only applies for call forwards
        to voicemail.

    Email address
        Send an email to the configured user address when a new voicemail is received. For user voicemails this value
        is configured in User edit screen.

    Attach sounds:
        Attach the audio message to the sent email.

.. note:: If voicemail locution is not assigned, default locution will be used as long as
          the owner has not recorded a custom message through the voicemail menu (calling to
          voicemail service code).
.. _notification_templates:

######################
Notification Templates
######################

Brand administators can configure the notifications sent by IvozProvider:

- Email sent when a new voicemail is received

- Email sent when a new fax is received

.. hint:: When no custom notification is configured, default ones will be used

Notifications are created in two steps: Create a notification type and add contents to the notification for each
required language.

***************************
Creating a new notification
***************************

Brand administrators can create new notification templates in **Brand configuration** > **Notification templates**:

Fields are nearly self-explanatory:

.. glossary::

    Name
        Used to identify this notification template

    Type
        Determine the notification type. Each notification type has its own substitution variables avaiable to replace
        the contents of the subject and body.

****************************
Adding Notification contents
****************************

Once the notification has been created, you can add different language contents. IvozProvider will automatically use
the proper language based on the destination:

 - For Voicemails, the user language will be used

 - For Faxes, the company language will be used.

Configurable fields of each content:

.. glossary::

    Language
        Language of the contents.

    From Name
        The from name used while sending emails (p.e. IvozProvider Voicemail Notifications)

    From Address
        The from address used while sending emails (p.e. no-replay@ivozprovider.com)

    Substitution variables
        Avaialble variables that can be used in subject and body that will be replaced before sending the email. Each
        notification type has its own variables.

    Subject
        Subject of the email to be sent. You can include Substitution variables here.

    Body
        HTML Body of the email to be sent. You can include Substitution variables here.

.. hint:: There is no need to create all content languages. If custom notification has some languages not defined the
        default contents will be used for that notification type.


********************************
Assigning templates to companies
********************************

Once the notification has been configured for the desired languages, Brand administrator must assign it to the
Company or Retail Client that will use it. This can be done in the Notification configuration section of Company and
Retail Client edit screen.
.. _notification_templates:
.. _notification templates:

######################
Notification Templates
######################

Brand administrators can configure the notifications sent by IvozProvider:

- Email sent when a new voicemail is received

- Email sent when a new fax is received

- Email sent when a balance is below configured threshold

- Email sent when an automatic invoice is generated

- Email sent when scheduled CDR CSVs are generated

- Email sent when max daily usage is reached

- Email sent with access credentials

.. hint:: When no custom notification is configured, default ones will be used

Notifications are created in two steps: Create a notification type and add contents to the notification for each
required language.

***************************
Creating a new notification
***************************

Brand administrators can create new notification templates in **Brand configuration** > **Notification templates**:

Fields are nearly self-explanatory:

    Name
        Used to identify this notification template

    Type
        Determine the notification type. Each notification type has its own substitution variables available to replace
        the contents of the subject and body.

****************************
Adding Notification contents
****************************

Once the notification has been created, you can add different language contents. IvozProvider will automatically use
the proper language based on the destination:

 - For Voicemails, the user language will be used

 - For Faxes, the client language will be used.

Configurable fields of each content:

    Language
        Language of the contents.

    From Name
        The from name used while sending emails (p.e. IvozProvider Voicemail Notifications)

    From Address
        The from address used while sending emails (p.e. no-reply@ivozprovider.com)

    Substitution variables
        Available variables that can be used in subject and body that will be replaced before sending the email. Each
        notification type has its own variables.

    Subject
        Subject of the email to be sent. You can include Substitution variables here.

    Body type
        Body of the mail can be both plaintext or html.

    Body
        Body of the email to be sent. You can include Substitution variables here.

.. hint:: There is no need to create all content languages. If custom notification has some languages not defined the
        default contents will be used for that notification type.

****************************************
Using variables in notification contents
****************************************

You can use variables in the subject and body of the email. Each notification type has its own set of variables
that can be used. The variables are replaced with the corresponding value before sending the email notification.

- **Voicemail Notifications**

    .. list-table::
         :widths: 20 80
         :header-rows: 0

         * - ``${VM_NAME}``
           - Voicemail User name
         * - ``${VM_DATE}``
           - Received date
         * - ``${VM_DUR}``
           - Voicemail duration
         * - ``${VM_CIDNAME}``
           - Caller name
         * - ``${VM_CIDNUM}``
           - Caller number
         * - ``${VM_MSGNUM}``
           - Voicemail Number

- **Fax Notifications**

    .. list-table::
         :widths: 20 80
         :header-rows: 0

         * - ``${FAX_NAME}``
           - Virtual Fax name
         * - ``${FAX_PDFNAME}``
           - Fax PDF filename
         * - ``${FAX_PAGES}``
           - Fax PDF page count
         * - ``${FAX_SRC}``
           - Origin number
         * - ``${FAX_DST}``
           - Received DDI number
         * - ``${FAX_DATE}``
           - Received Date

- **Invoice Notifications**

    .. list-table::
         :widths: 20 80
         :header-rows: 0

         * - ``${INVOICE_COMPANY}``
           - Company name
         * - ``${INVOICE_DATE_IN}``
           - Start date
         * - ``${INVOICE_DATE_OUT}``
           - End date
         * - ``${INVOICE_AMOUNT}``
           - Total amount with taxes
         * - ``${INVOICE_CURRENCY}``
           - Currency

- **Low Balance Notifications**

    .. list-table::
         :widths: 20 80
         :header-rows: 0

         * - ``${BALANCE_NAME}``
           - Company or carrier name
         * - ``${BALANCE_AMOUNT}``
           - Current balance amount

- **Call CSV Notifications**

    .. list-table::
         :widths: 20 80
         :header-rows: 0

         * - ``${CALLCSV_COMPANY}``
           - Company name
         * - ``${CALLCSV_DATE_IN}``
           - Start date
         * - ``${CALLCSV_DATE_OUT}``
           - End date

- **Max Daily Usage Notifications**

    .. list-table::
         :widths: 20 80
         :header-rows: 0

         * - ``${MAXDAILYUSAGE_COMPANY}``
           - Company name
         * - ``${MAXDAILYUSAGE_AMOUNT}``
           - Company max daily usage

******************************
Assigning templates to clients
******************************

Once the notification has been configured for the desired languages, Brand administrator can assign it to the
client that will use it. This can be done in the Notification configuration section of each client.
If client has no notification configured, brand notifications will be used for that client instead. If brand has no
notification configured, default notifications will be used.

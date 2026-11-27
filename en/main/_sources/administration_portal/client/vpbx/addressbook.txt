############
Address Book
############

Virtual PBX clients have access to a simple Address book to store contacts,
that can be used for third party integrations.

Contacts for vPBX users are automatically created and managed by the system,
but client administrators can add other external numbers to existing contacts.

*************
Personal data
*************

.. glossary::

    Name
        Name of the contact.

    Lastname
        Lastname of the contact.

    Email
        Email of the contact.

******
Phones
******

.. glossary::

    Work Phone
        Public external work number of the contact.

    Mobile Phone
        Public external mobile number of the contact.

    Other Phone
        Free format number of the contact (Internal Extension, Fax, etc)

*****************
CSV Import Format
*****************

Contacts can be created and updated in bulk with the *Import contacts* option of the Address Book
list menu. The dialog describes the format, offers a downloadable CSV template and shows the result
of every line. It is only shown to administrators with permission to create and update contacts.

The file may be encoded in UTF-8, with or without BOM, or in Windows-1252, so both the *CSV UTF-8* and the
plain *CSV* formats of Excel are accepted. Its first row must be a header naming the columns, which can be
separated by commas (,) or semicolons (;).

.. list-table::
     :widths: 25 15 60
     :header-rows: 1

     * - Column
       - Required
       - Notes
     * - ``id``
       - No
       - With a value, the contact with that id is updated. Empty or missing, a new contact is created.
     * - ``name``
       - To create
       - Cannot be left empty. Up to 100 characters.
     * - ``lastname``
       - No
       - Up to 100 characters.
     * - ``email``
       - No
       - Valid email address. Up to 100 characters.
     * - ``workPhoneCountry``, ``mobilePhoneCountry``
       - No
       - ISO country code (for example ``ES``). When there is a phone and no country, the client country
         is used.
     * - ``workPhone``, ``mobilePhone``
       - No
       - Number without international prefix. Up to 20 characters.
     * - ``otherPhone``
       - No
       - Free text. Up to 25 characters.

.. rubric:: Example CSV file

.. code-block:: none

    id,name,lastname,email,workPhoneCountry,workPhone,mobilePhoneCountry,mobilePhone,otherPhone
    ,Ana,García,ana@example.com,ES,944048182,ES,600000000,
    ,Juan,Pérez,,,,,,Fax 2010
    ,Marta,López,,,944000111,,,

The import follows these rules:

- A row without id always creates a new contact, even if an identical one already exists.
- A row with id updates that contact. If the id does not exist or belongs to another client, the row fails.
- A column present in the header but empty in a row deletes the value of that field.
- A column missing from the header is not modified when updating.
- Contacts linked to a user only update their phones and phone countries: name, lastname, email and other
  phone are ignored, as they are kept in sync with the user.
- Valid rows are saved and failed rows are reported with their line number in the file and the reason.

.. warning:: Import again only the failed lines once fixed. Importing the whole file again would duplicate
             the contacts created from rows without id.

**********
CSV Export
**********

The *Export contacts* option of the Address Book list menu downloads a CSV file with every contact that
matches the active filters, not only the ones shown in the current page. It is only shown to administrators
with permission to read contacts.

The file is meant to be edited and imported again, so it has exactly the columns of the import format, in the
same order, and every row has its ``id``. Countries are exported as ISO codes and phones without
international prefix, as they are stored. Contacts linked to a user are included like the rest.

It is encoded in UTF-8 with BOM and uses semicolons (;) as separator, so it opens directly in Excel keeping
accents and columns.

.. rubric:: Export, edit and import again

#. Export the contacts, filtering the list first if only some of them need changes.
#. Edit the values in the exported file keeping the ``id`` column: that is what makes the import update each
   contact instead of creating a new one.
#. Import the file with the *Import contacts* option. The contacts that were not changed are updated with
   their own values, so they stay as they were.

.. note:: A phone stored without country is exported with an empty country column. When the file is imported
          again, that phone takes the client country, as any phone without country does.

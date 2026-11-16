Feature: Contacts mass import
  In order to manage the address book
  As a client admin
  I need to be able to create and update contacts from a CSV file

  @createSchema
  Scenario: Mass import is not available through GET requests
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "/contacts/mass_import"
     Then the response status code should be 404

  Scenario: Mass import without csv file is a bad request
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "multipart/form-data; boundary=------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" multipart request to "/contacts/mass_import" with body:
    """
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8--

    """
     Then the response status code should be 400

  Scenario: Mass import is forbidden to non vPBX clients
    Given I add Retail Company Authorization header
     When I add "Content-Type" header equal to "multipart/form-data; boundary=------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" multipart request to "/contacts/mass_import" with body:
    """
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="csv"; filename="contacts.csv"
Content-Type: text/csv

id,name
,Ana
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8--

    """
     Then the response status code should be 403

  Scenario: Mass import is forbidden to restricted admins without write privileges on contacts
    Given I add restricted Company Authorization header
     When I add "Content-Type" header equal to "multipart/form-data; boundary=------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" multipart request to "/contacts/mass_import" with body:
    """
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="csv"; filename="contacts.csv"
Content-Type: text/csv

id,name
,Ana
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8--

    """
     Then the response status code should be 403

  Scenario: An empty file is reported as a file error
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "multipart/form-data; boundary=------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" multipart request to "/contacts/mass_import" with body:
    """
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="csv"; filename="contacts.csv"
Content-Type: text/csv


------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8--

    """
     Then the response status code should be 201
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
    {
        "created": 0,
        "updated": 0,
        "errors": [
            {
                "line": 0,
                "message": "The file is empty"
            }
        ]
    }
    """

  Scenario: A file without header is rejected as a whole
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "multipart/form-data; boundary=------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" multipart request to "/contacts/mass_import" with body:
    """
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="csv"; filename="contacts.csv"
Content-Type: text/csv

,Ana,García,ana@example.com,ES,944048182,ES,600000000,
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8--

    """
     Then the response status code should be 201
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
    {
        "created": 0,
        "updated": 0,
        "errors": [
            {
                "line": 0,
                "message": "Unknown column \"\" in the header. Allowed columns: id, name, lastname, email, workPhoneCountry, workPhone, mobilePhoneCountry, mobilePhone, otherPhone"
            }
        ]
    }
    """

  Scenario: The documentation example creates its contacts
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "multipart/form-data; boundary=------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" multipart request to "/contacts/mass_import" with body:
    """
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="csv"; filename="contacts.csv"
Content-Type: text/csv

id,name,lastname,email,workPhoneCountry,workPhone,mobilePhoneCountry,mobilePhone,otherPhone
,Ana,García,ana@example.com,ES,944048182,ES,600000000,
,Juan,Pérez,,,,,,Fax 2010
,Marta,López,,,944000111,,,
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8--

    """
     Then the response status code should be 201
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
    {
        "created": 3,
        "updated": 0,
        "errors": []
    }
    """

  Scenario: Created contacts have their E.164 phones
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "contacts/5"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
    {
        "name": "Ana",
        "lastname": "García",
        "email": "ana@example.com",
        "workPhone": "944048182",
        "workPhoneE164": "+34944048182",
        "mobilePhone": "600000000",
        "mobilePhoneE164": "+34600000000",
        "otherPhone": null,
        "id": 5,
        "user": null,
        "workPhoneCountry": {
            "code": "ES",
            "countryCode": "+34",
            "id": 68,
            "name": {
                "en": "Spain",
                "es": "España",
                "ca": "España",
                "it": "Spagna",
                "eu": "Spagna"
            },
            "zone": {
                "en": "Europe",
                "es": "Europa",
                "ca": "Europa",
                "it": "Europe",
                "eu": "Europa"
            }
        },
        "mobilePhoneCountry": {
            "code": "ES",
            "countryCode": "+34",
            "id": 68,
            "name": {
                "en": "Spain",
                "es": "España",
                "ca": "España",
                "it": "Spagna",
                "eu": "Spagna"
            },
            "zone": {
                "en": "Europe",
                "es": "Europa",
                "ca": "Europa",
                "it": "Europe",
                "eu": "Europa"
            }
        }
    }
    """

  Scenario: A phone without country uses the client country
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "contacts/7"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
    {
        "name": "Marta",
        "lastname": "López",
        "email": null,
        "workPhone": "944000111",
        "workPhoneE164": "+34944000111",
        "mobilePhone": null,
        "mobilePhoneE164": null,
        "otherPhone": null,
        "id": 7,
        "user": null,
        "workPhoneCountry": {
            "code": "ES",
            "countryCode": "+34",
            "id": 68,
            "name": {
                "en": "Spain",
                "es": "España",
                "ca": "España",
                "it": "Spagna",
                "eu": "Spagna"
            },
            "zone": {
                "en": "Europe",
                "es": "Europa",
                "ca": "Europa",
                "it": "Europe",
                "eu": "Europa"
            }
        },
        "mobilePhoneCountry": null
    }
    """

  Scenario: Semicolon separated rows with id update only the columns in the header
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "multipart/form-data; boundary=------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" multipart request to "/contacts/mass_import" with body:
    """
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="csv"; filename="contacts.csv"
Content-Type: text/csv

id;name;workPhone;otherPhone
1;Updated name;944000222;
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8--

    """
     Then the response status code should be 201
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
    {
        "created": 0,
        "updated": 1,
        "errors": []
    }
    """

  Scenario: Updated contact keeps the columns missing from the header
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "contacts/1"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
    {
        "name": "Updated name",
        "lastname": "Test Contact Lastname",
        "email": "testcontact@email.com",
        "workPhone": "944000222",
        "workPhoneE164": "+34944000222",
        "mobilePhone": "111222",
        "mobilePhoneE164": "+34111222",
        "otherPhone": null,
        "id": 1,
        "user": null,
        "workPhoneCountry": {
            "code": "ES",
            "countryCode": "+34",
            "id": 68,
            "name": {
                "en": "Spain",
                "es": "España",
                "ca": "España",
                "it": "Spagna",
                "eu": "Spagna"
            },
            "zone": {
                "en": "Europe",
                "es": "Europa",
                "ca": "Europa",
                "it": "Europe",
                "eu": "Europa"
            }
        },
        "mobilePhoneCountry": {
            "code": "ES",
            "countryCode": "+34",
            "id": 68,
            "name": {
                "en": "Spain",
                "es": "España",
                "ca": "España",
                "it": "Spagna",
                "eu": "Spagna"
            },
            "zone": {
                "en": "Europe",
                "es": "Europa",
                "ca": "Europa",
                "it": "Europe",
                "eu": "Europa"
            }
        }
    }
    """

  Scenario: Contacts linked to a user only update their phones
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "multipart/form-data; boundary=------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" multipart request to "/contacts/mass_import" with body:
    """
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="csv"; filename="contacts.csv"
Content-Type: text/csv

id,name,lastname,email,workPhoneCountry,workPhone,mobilePhoneCountry,mobilePhone,otherPhone
2,,,,ES,944000333,ES,600000333,
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8--

    """
     Then the response status code should be 201
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
    {
        "created": 0,
        "updated": 1,
        "errors": []
    }
    """

  Scenario: Contact linked to a user keeps its personal data
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "contacts/2"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
    {
        "name": "Alice",
        "lastname": "Allison",
        "email": "alice@democompany.com",
        "workPhone": "944000333",
        "workPhoneE164": "+34944000333",
        "mobilePhone": "600000333",
        "mobilePhoneE164": "+34600000333",
        "otherPhone": "101",
        "id": 2,
        "user": {
            "name": "Alice",
            "lastname": "Allison",
            "email": "alice@democompany.com",
            "pass": "*****",
            "doNotDisturb": false,
            "isBoss": false,
            "active": true,
            "maxCalls": 1,
            "externalIpCalls": "0",
            "rejectCallMethod": "rfc",
            "multiContact": true,
            "gsQRCode": false,
            "useDefaultLocation": true,
            "id": 1,
            "callAcl": null,
            "bossAssistant": null,
            "bossAssistantWhiteList": null,
            "transformationRuleSet": 1,
            "language": null,
            "terminal": 1,
            "extension": null,
            "timezone": 145,
            "outgoingDdi": 3,
            "outgoingDdiRule": null,
            "location": 1,
            "voicemail": null,
            "contact": null
        },
        "workPhoneCountry": {
            "code": "ES",
            "countryCode": "+34",
            "id": 68,
            "name": {
                "en": "Spain",
                "es": "España",
                "ca": "España",
                "it": "Spagna",
                "eu": "Spagna"
            },
            "zone": {
                "en": "Europe",
                "es": "Europa",
                "ca": "Europa",
                "it": "Europe",
                "eu": "Europa"
            }
        },
        "mobilePhoneCountry": {
            "code": "ES",
            "countryCode": "+34",
            "id": 68,
            "name": {
                "en": "Spain",
                "es": "España",
                "ca": "España",
                "it": "Spagna",
                "eu": "Spagna"
            },
            "zone": {
                "en": "Europe",
                "es": "Europa",
                "ca": "Europa",
                "it": "Europe",
                "eu": "Europa"
            }
        }
    }
    """

  Scenario: Valid rows are imported and the rest are reported with their file line
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "multipart/form-data; boundary=------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" multipart request to "/contacts/mass_import" with body:
    """
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="csv"; filename="contacts.csv"
Content-Type: text/csv

id,name,lastname,email,workPhoneCountry,workPhone
,Valid,Contact,,,

4,Other client,Contact,,,
9999,Missing,Contact,,,
,,No name,,,
,Wrong,Country,,XX,944000444
,Wrong,Email,not-an-email,,
,Missing,Columns
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8--

    """
     Then the response status code should be 201
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
    {
        "created": 1,
        "updated": 0,
        "errors": [
            {
                "line": 4,
                "message": "Contact 4 not found"
            },
            {
                "line": 5,
                "message": "Contact 9999 not found"
            },
            {
                "line": 6,
                "message": "Name is required to create a contact"
            },
            {
                "line": 7,
                "message": "Country XX not found"
            },
            {
                "line": 8,
                "message": "Value \"not-an-email\" was expected to be a valid e-mail address."
            },
            {
                "line": 9,
                "message": "6 columns were expected but 3 found"
            }
        ]
    }
    """

  Scenario: A failed row does not modify its contact
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "multipart/form-data; boundary=------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" multipart request to "/contacts/mass_import" with body:
    """
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="csv"; filename="contacts.csv"
Content-Type: text/csv

id,name,email
1,Not saved,not-an-email
,Saved after the failed row,
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8--

    """
     Then the response status code should be 201
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
    {
        "created": 1,
        "updated": 0,
        "errors": [
            {
                "line": 2,
                "message": "Value \"not-an-email\" was expected to be a valid e-mail address."
            }
        ]
    }
    """

  Scenario: The contact of the failed row keeps its values
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "contacts/1"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
    {
        "name": "Updated name",
        "lastname": "Test Contact Lastname",
        "email": "testcontact@email.com",
        "workPhone": "944000222",
        "workPhoneE164": "+34944000222",
        "mobilePhone": "111222",
        "mobilePhoneE164": "+34111222",
        "otherPhone": null,
        "id": 1,
        "user": null,
        "workPhoneCountry": {
            "code": "ES",
            "countryCode": "+34",
            "id": 68,
            "name": {
                "en": "Spain",
                "es": "España",
                "ca": "España",
                "it": "Spagna",
                "eu": "Spagna"
            },
            "zone": {
                "en": "Europe",
                "es": "Europa",
                "ca": "Europa",
                "it": "Europe",
                "eu": "Europa"
            }
        },
        "mobilePhoneCountry": {
            "code": "ES",
            "countryCode": "+34",
            "id": 68,
            "name": {
                "en": "Spain",
                "es": "España",
                "ca": "España",
                "it": "Spagna",
                "eu": "Spagna"
            },
            "zone": {
                "en": "Europe",
                "es": "Europa",
                "ca": "Europa",
                "it": "Europe",
                "eu": "Europa"
            }
        }
    }
    """

  Scenario: A file saved with BOM is imported
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "multipart/form-data; boundary=------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" multipart request to "/contacts/mass_import" with body:
    """
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="csv"; filename="contacts.csv"
Content-Type: text/csv

﻿id;name;lastname
;Begoña;Ibáñez
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8--

    """
     Then the response status code should be 201
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
    {
        "created": 1,
        "updated": 0,
        "errors": []
    }
    """

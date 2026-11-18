Feature: Retrieve contacts
  In order to manage contacts
  As a client admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the contacts json list
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "contacts"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      [
          {
              "name": "Alice",
              "lastname": "Allison",
              "email": "alice@democompany.com",
              "workPhoneE164": null,
              "mobilePhoneE164": null,
              "otherPhone": "101",
              "id": 2,
              "user": 1
          },
          {
              "name": "Bob",
              "lastname": "Bobson",
              "email": "bob@democompany.com",
              "workPhoneE164": null,
              "mobilePhoneE164": null,
              "otherPhone": "102",
              "id": 3,
              "user": 2
          },
          {
              "name": "Test Contact name",
              "lastname": "Test Contact Lastname",
              "email": "testcontact@email.com",
              "workPhoneE164": "+34456123",
              "mobilePhoneE164": "+34111222",
              "otherPhone": "4001",
              "id": 1,
              "user": null
          }
      ]
      """

  Scenario: Retrieve certain contacts json
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "contacts/1"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      {
          "name": "Test Contact name",
          "lastname": "Test Contact Lastname",
          "email": "testcontact@email.com",
          "workPhone": "456123",
          "workPhoneE164": "+34456123",
          "mobilePhone": "111222",
          "mobilePhoneE164": "+34111222",
          "otherPhone": "4001",
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

  # The csv responses start with the UTF-8 BOM, present but invisible in the expected text
  Scenario: Retrieve the contacts csv list with the import columns
    Given I add Company Authorization header
     When I add "Accept" header equal to "text/csv"
      And I send a "GET" request to "contacts?_pagination=false"
     Then the response status code should be 200
      And the header "Content-Type" should be equal to "text/csv; charset=utf-8"
      And the streamed response should be equal to:
      """
      ﻿id;name;lastname;email;workPhoneCountry;workPhone;mobilePhoneCountry;mobilePhone;otherPhone
      2;Alice;Allison;alice@democompany.com;;;;;101
      3;Bob;Bobson;bob@democompany.com;ES;;;678876102;102
      1;"Test Contact name";"Test Contact Lastname";testcontact@email.com;ES;456123;ES;111222;4001
      """

  Scenario: The contacts csv list applies the collection filters
    Given I add Company Authorization header
     When I add "Accept" header equal to "text/csv"
      And I send a "GET" request to "contacts?_pagination=false&name=Bob"
     Then the response status code should be 200
      And the streamed response should be equal to:
      """
      ﻿id;name;lastname;email;workPhoneCountry;workPhone;mobilePhoneCountry;mobilePhone;otherPhone
      3;Bob;Bobson;bob@democompany.com;ES;;;678876102;102
      """

  Scenario: A restricted admin without read privileges on contacts cannot export them
    Given I add restricted Company Authorization header
     When I add "Accept" header equal to "text/csv"
      And I send a "GET" request to "contacts?_pagination=false"
     Then the response status code should be 403

  Scenario: Create a contact with accents, separators and quotes
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/contacts" with body:
      """
      {
          "name": "Núñez \"Pepe\"",
          "lastname": "O'Brien; Jr, III",
          "email": "pepe@example.com",
          "otherPhone": "Fax 2010"
      }
      """
     Then the response status code should be 201

  Scenario: Accents, separators and quotes are exported escaped
    Given I add Company Authorization header
     When I add "Accept" header equal to "text/csv"
      And I send a "GET" request to "contacts?_pagination=false&email=pepe@example.com"
     Then the response status code should be 200
      And the streamed response should be equal to:
      """
      ﻿id;name;lastname;email;workPhoneCountry;workPhone;mobilePhoneCountry;mobilePhone;otherPhone
      5;"Núñez ""Pepe""";"O'Brien; Jr, III";pepe@example.com;;;;;"Fax 2010"
      """

  Scenario: Importing the exported csv updates the contacts without creating any
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "multipart/form-data; boundary=------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" multipart request to "/contacts/mass_import" with body:
    """
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="csv"; filename="contacts.csv"
Content-Type: text/csv

﻿id;name;lastname;email;workPhoneCountry;workPhone;mobilePhoneCountry;mobilePhone;otherPhone
2;Alice;Allison;alice@democompany.com;;;;;101
3;Bob;Bobson;bob@democompany.com;ES;;;678876102;102
5;"Núñez ""Pepe""";"O'Brien; Jr, III";pepe@example.com;;;;;"Fax 2010"
1;"Test Contact name";"Test Contact Lastname";testcontact@email.com;ES;456123;ES;111222;4001
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8--

    """
     Then the response status code should be 201
      And the response should be in JSON
      And the JSON should be equal to:
      """
      {
          "created": 0,
          "updated": 4,
          "errors": []
      }
      """

  Scenario: The reimported contacts keep their values and a phone without country gets the client one
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "contacts"
     Then the response status code should be 200
      And the JSON should be equal to:
      """
      [
          {
              "name": "Alice",
              "lastname": "Allison",
              "email": "alice@democompany.com",
              "workPhoneE164": null,
              "mobilePhoneE164": null,
              "otherPhone": "101",
              "id": 2,
              "user": 1
          },
          {
              "name": "Bob",
              "lastname": "Bobson",
              "email": "bob@democompany.com",
              "workPhoneE164": null,
              "mobilePhoneE164": "+34678876102",
              "otherPhone": "102",
              "id": 3,
              "user": 2
          },
          {
              "name": "Núñez \"Pepe\"",
              "lastname": "O'Brien; Jr, III",
              "email": "pepe@example.com",
              "workPhoneE164": null,
              "mobilePhoneE164": null,
              "otherPhone": "Fax 2010",
              "id": 5,
              "user": null
          },
          {
              "name": "Test Contact name",
              "lastname": "Test Contact Lastname",
              "email": "testcontact@email.com",
              "workPhoneE164": "+34456123",
              "mobilePhoneE164": "+34111222",
              "otherPhone": "4001",
              "id": 1,
              "user": null
          }
      ]
      """

  Scenario: Importing the exported csv with one edited row updates that contact
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "multipart/form-data; boundary=------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" multipart request to "/contacts/mass_import" with body:
    """
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="csv"; filename="contacts.csv"
Content-Type: text/csv

﻿id;name;lastname;email;workPhoneCountry;workPhone;mobilePhoneCountry;mobilePhone;otherPhone
2;Alice;Allison;alice@democompany.com;;;;;101
3;Bob;Bobson;bob@democompany.com;ES;;;678876102;102
5;"Núñez ""Pepe""";"O'Brien; Jr, III";pepe@example.com;;;;;"Fax 2010"
1;"Test Contact name";"Test Contact Lastname";testcontact@email.com;ES;456999;ES;111222;4001
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8--

    """
     Then the response status code should be 201
      And the response should be in JSON
      And the JSON should be equal to:
      """
      {
          "created": 0,
          "updated": 4,
          "errors": []
      }
      """

  Scenario: The edited contact has the new value and the rest keep theirs
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "contacts"
     Then the response status code should be 200
      And the JSON should be equal to:
      """
      [
          {
              "name": "Alice",
              "lastname": "Allison",
              "email": "alice@democompany.com",
              "workPhoneE164": null,
              "mobilePhoneE164": null,
              "otherPhone": "101",
              "id": 2,
              "user": 1
          },
          {
              "name": "Bob",
              "lastname": "Bobson",
              "email": "bob@democompany.com",
              "workPhoneE164": null,
              "mobilePhoneE164": "+34678876102",
              "otherPhone": "102",
              "id": 3,
              "user": 2
          },
          {
              "name": "Núñez \"Pepe\"",
              "lastname": "O'Brien; Jr, III",
              "email": "pepe@example.com",
              "workPhoneE164": null,
              "mobilePhoneE164": null,
              "otherPhone": "Fax 2010",
              "id": 5,
              "user": null
          },
          {
              "name": "Test Contact name",
              "lastname": "Test Contact Lastname",
              "email": "testcontact@email.com",
              "workPhoneE164": "+34456999",
              "mobilePhoneE164": "+34111222",
              "otherPhone": "4001",
              "id": 1,
              "user": null
          }
      ]
      """

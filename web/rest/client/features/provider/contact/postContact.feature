Feature: Create contacts
  In order to manage contacts
  As a client admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create a contact
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/contacts" with body:
    """
      {
          "name": "New",
          "lastname": "Contact",
          "email": "newcontact@example.com",
          "workPhoneCountry": 68,
          "workPhone": "111222333",
          "mobilePhoneCountry": 68,
          "mobilePhone": "333222111",
          "otherPhone": "+34123456789"
      }
    """
    Then the response status code should be 201
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be equal to:
    """
      {
          "name": "New",
          "lastname": "Contact",
          "email": "newcontact@example.com",
          "workPhone": "111222333",
          "workPhoneE164": "+34111222333",
          "mobilePhone": "333222111",
          "mobilePhoneE164": "+34333222111",
          "otherPhone": "+34123456789",
          "id": 4,
          "user": null,
          "workPhoneCountry": 68,
          "mobilePhoneCountry": 68
      }
    """

  Scenario: Retrieve created contact
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "contacts/4"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
    """
      {
          "name": "New",
          "lastname": "Contact",
          "email": "newcontact@example.com",
          "workPhone": "111222333",
          "workPhoneE164": "+34111222333",
          "mobilePhone": "333222111",
          "mobilePhoneE164": "+34333222111",
          "otherPhone": "+34123456789",
          "id": 4,
          "user": null,
          "workPhoneCountry": {
              "code": "ES",
              "countryCode": "+34",
              "id": 68,
              "name": {
                  "en": "Spain",
                  "es": "Espa\u00f1a",
                  "ca": "Espa\u00f1a",
                  "it": "Spagna"
              },
              "zone": {
                  "en": "Europe",
                  "es": "Europa",
                  "ca": "Europa",
                  "it": "Europe"
              }
          },
          "mobilePhoneCountry": {
              "code": "ES",
              "countryCode": "+34",
              "id": 68,
              "name": {
                  "en": "Spain",
                  "es": "Espa\u00f1a",
                  "ca": "Espa\u00f1a",
                  "it": "Spagna"
              },
              "zone": {
                  "en": "Europe",
                  "es": "Europa",
                  "ca": "Europa",
                  "it": "Europe"
              }
          }
      }
    """

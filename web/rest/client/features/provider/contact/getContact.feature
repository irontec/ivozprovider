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
              "name": "Test Contact name",
              "lastname": "Test Contact Lastname",
              "email": "testcontact@email.com",
              "workPhoneE164": "+34456123",
              "mobilePhoneE164": "+34111222",
              "otherPhone": "4001",
              "id": 1
          },
          {
              "name": "Alice",
              "lastname": "Allison",
              "email": "alice@democompany.com",
              "workPhoneE164": null,
              "mobilePhoneE164": null,
              "otherPhone": "101",
              "id": 2
          },
          {
              "name": "Bob",
              "lastname": "Bobson",
              "email": "bob@democompany.com",
              "workPhoneE164": null,
              "mobilePhoneE164": null,
              "otherPhone": "102",
              "id": 3
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

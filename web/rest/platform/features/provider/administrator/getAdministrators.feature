Feature: Retrieve administrators
  In order to manage administrators
  As an super admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the administrators json list
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "administrators"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
      [
          {
              "email": "admin@example.com",
              "active": true,
              "name": "admin",
              "lastname": "ivozprovider",
              "id": 1
          },
          {
              "email": "nightwatch@irontec.com",
              "active": true,
              "name": "night",
              "lastname": "watch",
              "id": 2
          },
          {
              "email": "vozip@irontec.com",
              "active": true,
              "name": "irontec",
              "lastname": "ivozprovider",
              "id": 3
          },
          {
              "email": "test@irontec.com",
              "active": true,
              "name": "Admin Name",
              "lastname": "Admin Lastname",
              "id": 4
          },
          {
              "email": "utc@irontec.com",
              "active": true,
              "name": "Admin in UTC timezone",
              "lastname": "Admin Lastname",
              "id": 5
          }
      ]
    """

  Scenario: Retrieve certain administrator json
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "administrators/1"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
      {
          "username": "admin",
          "pass": "****",
          "email": "admin@example.com",
          "active": true,
          "name": "admin",
          "lastname": "ivozprovider",
          "id": 1,
          "brand": null,
          "company": null,
          "timezone": {
              "tz": "Europe/Madrid",
              "comment": "mainland",
              "id": 1,
              "label": {
                  "en": "en",
                  "es": "es"
              },
              "country": 1
          }
      }
    """

  Scenario: Administrator with id zero is filtered
    Given I add Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "administrators/0"
    Then the response status code should be 404

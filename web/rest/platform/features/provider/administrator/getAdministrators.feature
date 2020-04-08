Feature: Retrieve administrators
  In order to manage administrators
  as a super admin
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
              "username": "admin",
              "email": "admin@example.com",
              "active": true,
              "restricted": false,
              "name": "admin",
              "lastname": "ivozprovider",
              "id": 1
          },
          {
              "username": "test_brand_admin",
              "email": "nightwatch@irontec.com",
              "active": true,
              "restricted": false,
              "name": "night",
              "lastname": "watch",
              "id": 2
          },
          {
              "username": "irontec",
              "email": "vozip@irontec.com",
              "active": true,
              "restricted": false,
              "name": "irontec",
              "lastname": "ivozprovider",
              "id": 3
          },
          {
              "username": "utcAdmin",
              "email": "utc@irontec.com",
              "active": true,
              "restricted": true,
              "name": "Admin in UTC timezone",
              "lastname": "Admin Lastname",
              "id": 5
          },
          {
              "username": "restrictedBrandAdmin",
              "email": "restrictedAdmin@irontec.com",
              "active": true,
              "restricted": true,
              "name": "RestrictedAdmin",
              "lastname": "Lastname",
              "id": 6
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
          "restricted": false,
          "name": "admin",
          "lastname": "ivozprovider",
          "id": 1,
          "brand": null,
          "company": null,
          "timezone": {
              "tz": "Europe/Madrid",
              "comment": "mainland",
              "id": 145,
              "label": {
                  "en": "en",
                  "es": "es",
                  "ca": "ca",
                  "it": "it"
              },
              "country": 68
          }
      }
    """

  Scenario: Administrator with id zero is filtered
    Given I add Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "administrators/0"
    Then the response status code should be 404



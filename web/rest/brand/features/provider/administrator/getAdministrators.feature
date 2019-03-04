Feature: Retrieve administrators
  In order to manage administrators
  As an super admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the administrators json list
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "administrators"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
      [
          {
              "email": "nightwatch@irontec.com",
              "active": true,
              "name": "night",
              "lastname": "watch",
              "id": 2
          },
          {
              "email": "test@irontec.com",
              "active": true,
              "name": "Admin Name",
              "lastname": "Admin Lastname",
              "id": 4
          }
      ]
    """

  Scenario: Retrieve certain administrator json
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "administrators/2"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
    """
      {
          "username": "test_brand_admin",
          "pass": "****",
          "email": "nightwatch@irontec.com",
          "active": true,
          "name": "night",
          "lastname": "watch",
          "id": 2,
          "brand": "~",
          "company": null,
          "timezone": {
              "tz": "Europe\/Madrid",
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

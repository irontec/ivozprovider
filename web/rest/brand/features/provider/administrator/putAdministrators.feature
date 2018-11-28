Feature: Update administrators
  In order to manage administrators
  As an super admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update an administrators
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/administrators/4" with body:
    """
      {
          "username": "newUserName",
          "pass": "1234",
          "email": "modified@example.com",
          "active": false,
          "name": "Updated admin name",
          "lastname": "a lastname",
          "brand": 1,
          "company": 1,
          "timezone": 2
      }
    """
    Then the response status code should be 200
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be like:
    """
      {
          "username": "newUserName",
          "pass": "****",
          "email": "modified@example.com",
          "active": false,
          "name": "Updated admin name",
          "lastname": "a lastname",
          "id": 4,
          "brand": "~",
          "company": "~",
          "timezone": {
              "tz": "Europe\/London",
              "comment": null,
              "id": 2,
              "label": {
                  "en": "en",
                  "es": "es"
              },
              "country": 2
          }
      }
    """

  @createSchema
  Scenario: Fails on unauthorized company
    Given I add Brand Authorization header
    When I add "Content-Type" header equal to "application/json"
    And I add "Accept" header equal to "application/json"
    And I send a "PUT" request to "/administrators/4" with body:
    """
      {
          "username": "newUserName",
          "pass": "1234",
          "email": "modified@example.com",
          "active": false,
          "name": "Updated admin name",
          "lastname": "a lastname",
          "brand": 1,
          "company": 99,
          "timezone": 2
      }
    """
    Then the response status code should be 403
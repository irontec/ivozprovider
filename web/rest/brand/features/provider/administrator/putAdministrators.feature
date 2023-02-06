Feature: Update administrators
  In order to manage administrators
  As a brand admin
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
          "restricted": true,
          "name": "Updated admin name",
          "lastname": "a lastname",
          "company": 1,
          "timezone": 158
      }
      """
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      {
          "username": "newUserName",
          "pass": "*****",
          "email": "modified@example.com",
          "active": false,
          "restricted": true,
          "name": "Updated admin name",
          "lastname": "a lastname",
          "id": 4,
          "company": 1,
          "timezone": 158
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
          "restricted": true,
          "name": "Updated admin name",
          "lastname": "a lastname",
          "company": 99,
          "timezone": 2
      }
      """
     Then the response status code should be 403

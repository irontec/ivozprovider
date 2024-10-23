Feature: Retrieve media relay sets
  In order to manage application server sets
  As a brand admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the media relay sets json list
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "media_relay_sets"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      [
          {
              "name": "Default",
              "description": "Default media relay set",
              "id": 0
          },
          {
              "name": "Test",
              "description": "Test media relay set",
              "id": 1
          }
      ]
      """

  @createSchema
  Scenario: Retrieve the media relay sets json item
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "media_relay_sets/0"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      {
          "name": "Default",
          "description": "Default media relay set",
          "id": 0
      }
      """

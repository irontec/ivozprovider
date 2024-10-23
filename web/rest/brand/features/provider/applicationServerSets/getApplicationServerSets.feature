Feature: Retrieve application server sets
  In order to manage application server sets
  As a brand admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the application server sets json list
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "application_server_sets"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      [
          {
              "name": "BlueApSet",
              "distributeMethod": "hash",
              "description": "An Application Server Set",
              "id": 1
          },
          {
              "name": "default",
              "distributeMethod": "hash",
              "description": "Default application server set",
              "id": 0
          }
      ]
      """

  @createSchema
  Scenario: Retrieve the application server sets json item
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "application_server_sets/0"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      {
          "name": "default",
          "distributeMethod": "hash",
          "description": "Default application server set",
          "id": 0,
          "applicationServers": [
              1,
              2,
              3
          ]
      }
      """

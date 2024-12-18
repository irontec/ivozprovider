Feature: Retrieve applicationServers
  In order to manage application server sets
  as a super admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the application server sets json list
    Given I add Authorization header
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
              "name": "GreenApSet",
              "distributeMethod": "rr",
              "description": "Another Application Server Set",
              "id": 2
          },
          {
              "name": "default",
              "distributeMethod": "hash",
              "description": "Default application server set",
              "id": 0
          }
      ]
      """

  Scenario: Retrieve default application server set json
    Given I add Authorization header
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
              2
          ]
      }
      """

  Scenario: Retrieve a application server set json
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "application_server_sets/1"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      {
          "name": "BlueApSet",
          "distributeMethod": "hash",
          "description": "An Application Server Set",
          "id": 1,
          "applicationServers": [
              1,
              2
          ]
      }
      """

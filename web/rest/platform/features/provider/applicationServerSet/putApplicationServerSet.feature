Feature: Update application server set
  In order to manage application server sets
  as a super admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update an applicationServer
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/application_server_sets/1" with body:
      """
      {
        "name": "UpdateApSet",
        "distributeMethod": "rr",
        "description": "An Updated Application Server Set",
        "applicationServers": [
          1,
          3
        ]
      }
      """
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      {
        "name": "UpdateApSet",
        "distributeMethod": "rr",
        "description": "An Updated Application Server Set",
        "id": 1,
        "applicationServers": [
          1,
          3
        ]
      }
      """

  @createSchema
  Scenario: Application server set with id zero cannot be edited
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/application_server_sets/0" with body:
      """
      {
         "description": "updated description"
      }
      """
     Then the response status code should be 403

  @createSchema
  Scenario: Application server can not have all applicationServers removed
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/application_server_sets/1" with body:
      """
      {
          "applicationServers": []
      }
      """
     Then the response status code should be 400

  @createSchema
  Scenario: Application server can remove applicationServers 2 and add 3
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/application_server_sets/0" with body:
      """
      {
          "name": "default",
          "distributeMethod": "hash",
          "description": "Default application server set",
          "applicationServers": [
              2,
              3
          ]
      }
      """
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
            2,
            3
          ]
      }
      """

  @createSchema
  Scenario: Application server can remove applicationServers 1 and add 3
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/application_server_sets/1" with body:
      """
      {
          "applicationServers": [
              2,
              3
          ]
      }
      """
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
              2,
              3
          ]
      }
      """

Feature: Retrieve applicationServers
  In order to manage application servers
  as a super admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the application servers json list
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "application_servers"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      [
          {
              "ip": "127.0.0.1",
              "name": "as001",
              "id": 1
          },
          {
              "ip": "127.1.1.1",
              "name": "test001",
              "id": 2
          },
          {
              "ip": "127.1.1.2",
              "name": "test002",
              "id": 3
          },
          {
              "ip": "127.1.1.4",
              "name": "test004",
              "id": 4
          }
      ]
      """

  Scenario: Retrieve certain application server json
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "application_servers/1"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      {
          "ip": "127.0.0.1",
          "name": "as001",
          "id": 1
      }
      """

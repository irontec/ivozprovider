Feature: Create route locks
  In order to manage route locks
  As a client admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create a route lock
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/route_locks" with body:
      """
      {
          "name": "New Lock",
          "open": false,
          "closeExtension": "readOnly",
          "openExtension": "readOnly",
          "toggleExtension": "readOnly"
      }
      """
     Then the response status code should be 201
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      {
          "name": "New Lock",
          "description": "",
          "open": false,
          "id": 3,
          "closeExtension": "",
          "openExtension": "",
          "toggleExtension": ""
      }
      """

  Scenario: Retrieve created route lock
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "route_locks/3"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
      """
      {
          "name": "New Lock",
          "description": "",
          "open": false,
          "id": 3,
          "closeExtension": "",
          "openExtension": "",
          "toggleExtension": ""
      }
      """

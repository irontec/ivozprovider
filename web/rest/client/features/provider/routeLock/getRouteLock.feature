Feature: Retrieve route locks
  In order to manage route locks
  As a client admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the route locks json list
    Given I add Company Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "route_locks"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      [
          {
              "name": "Lock name",
              "description": "Lock description",
              "open": true,
              "id": 1,
              "closeExtension": "",
              "openExtension": "",
              "toggleExtension": ""
          },
          {
              "name": "Test Lock",
              "description": "Test Lock",
              "open": true,
              "id": 2,
              "closeExtension": "",
              "openExtension": "",
              "toggleExtension": ""
          }
      ]
    """

  Scenario: Retrieve certain route lock json
    Given I add Company Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "route_locks/1"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be like:
    """
      {
          "name": "Lock name",
          "description": "Lock description",
          "open": true,
          "id": 1,
          "closeExtension": "",
          "openExtension": "",
          "toggleExtension": ""
      }
    """

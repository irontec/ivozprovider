Feature: Retrieve media relay sets
  In order to manage media relay sets
  As an super admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the media relay sets json list
    Given I add Authorization header
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
              "id": 1
          },
          {
              "name": "Test",
              "description": "Test media relay set",
              "id": 2
          }
      ]
    """

  Scenario: Retrieve certain media relay set json
    Given I add Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "media_relay_sets/1"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      {
          "name": "Default",
          "description": "Default media relay set",
          "id": 1
      }
    """

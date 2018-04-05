Feature: Retrieve routing pattern groups
  In order to manage routing pattern groups
  As an super admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the routing pattern groups json list
    Given I add Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "routing_pattern_groups"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      [
          {
              "name": "Europe",
              "description": "",
              "id": 1
          },
          {
              "name": "Empty",
              "description": "Empty",
              "id": 2
          }
      ]
    """

  Scenario: Retrieve certain routing pattern group json
    Given I add Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "routing_pattern_groups/1"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be like:
    """
      {
          "name": "Europe",
          "description": "",
          "id": 1,
          "brand": "~"
      }
    """

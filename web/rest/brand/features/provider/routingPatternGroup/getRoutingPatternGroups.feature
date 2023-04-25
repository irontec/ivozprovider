Feature: Retrieve routing pattern groups
  In order to manage routing pattern groups
  As a brand admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the routing pattern groups json list
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "routing_pattern_groups"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      [
          {
              "name": "Empty",
              "description": "Empty",
              "id": 2,
              "patternIds": [
                  1
              ]
          },
          {
              "name": "Europe",
              "description": "",
              "id": 1,
              "patternIds": [
                  1
              ]
          }
      ]
      """

  Scenario: Retrieve certain routing pattern group json
    Given I add Brand Authorization header
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
          "patternIds": [
              1
          ]
      }
      """

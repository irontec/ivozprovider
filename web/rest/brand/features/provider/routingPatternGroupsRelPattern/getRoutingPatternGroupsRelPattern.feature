Feature: Retrieve routing pattern groups rel patterns
  In order to manage routing pattern groups rel patterns
  As an super admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the routing pattern groups rel patterns json list
    Given I add Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "routing_pattern_groups_rel_patterns"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      [
          {
              "id": 1,
              "routingPattern": {
                  "prefix": "+34",
                  "id": 1,
                  "name": {
                      "en": "en",
                      "es": "es"
                  },
                  "description": {
                      "en": "en",
                      "es": "es"
                  },
                  "brand": 1
              },
              "routingPatternGroup": {
                  "name": "Europe",
                  "description": "",
                  "id": 1,
                  "brand": 1
              }
          },
          {
              "id": 2,
              "routingPattern": {
                  "prefix": "+34",
                  "id": 1,
                  "name": {
                      "en": "en",
                      "es": "es"
                  },
                  "description": {
                      "en": "en",
                      "es": "es"
                  },
                  "brand": 1
              },
              "routingPatternGroup": {
                  "name": "Empty",
                  "description": "Empty",
                  "id": 2,
                  "brand": 1
              }
          }
      ]
    """

  Scenario: Retrieve certain routing pattern groups rel pattern json
    Given I add Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "routing_pattern_groups_rel_patterns/1"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      {
          "id": 1,
          "routingPattern": {
              "prefix": "+34",
              "id": 1,
              "name": {
                  "en": "en",
                  "es": "es"
              },
              "description": {
                  "en": "en",
                  "es": "es"
              },
              "brand": 1
          },
          "routingPatternGroup": {
              "name": "Europe",
              "description": "",
              "id": 1,
              "brand": 1
          }
      }
    """

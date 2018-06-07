Feature: Create routing pattern groups rel patterns
  In order to manage routing pattern groups rel patterns
  As an super admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create a routing pattern groups rel pattern
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/routing_pattern_groups_rel_patterns" with body:
    """
      {
          "routingPattern": 2,
          "routingPatternGroup": 1
      }
    """
    Then the response status code should be 201
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be equal to:
    """
      {
          "id": 3,
          "routingPattern": {
              "prefix": "+35",
              "id": 2,
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

  Scenario: Retrieve created routing pattern groups rel pattern
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "routing_pattern_groups_rel_patterns/3"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
      {
          "id": 3,
          "routingPattern": {
              "prefix": "+35",
              "id": 2,
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

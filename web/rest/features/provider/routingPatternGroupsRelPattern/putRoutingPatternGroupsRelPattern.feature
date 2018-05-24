Feature: Update routing pattern groups rel patterns
  In order to manage routing pattern groups rel patterns
  As an super admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update a routing pattern group rel pattern
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/routing_pattern_groups_rel_patterns/1" with body:
    """
      {
          "routingPattern": 2,
          "routingPatternGroup": 2
      }
    """
    Then the response status code should be 200
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be equal to:
    """
      {
          "id": 1,
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
              "name": "Empty",
              "description": "Empty",
              "id": 2,
              "brand": 1
          }
      }
    """

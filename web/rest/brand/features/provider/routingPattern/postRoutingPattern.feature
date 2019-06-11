Feature: Create routing patterns
  In order to manage routing patterns
  As an super admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create a routing patterns
    Given I add Brand Authorization header
    When I add "Content-Type" header equal to "application/json"
    And I add "Accept" header equal to "application/json"
    And I send a "POST" request to "/routing_patterns" with body:
    """
      {
          "prefix": "+349",
          "id": 1,
          "name": {
              "en": "Spain",
              "es": "España"
          },
          "description": {
              "en": "desc en",
              "es": "desc es"
          }
      }
    """
    Then the response status code should be 201
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      {
          "prefix": "+349",
          "id": 3,
          "name": {
              "en": "Spain",
              "es": "Espa\u00f1a"
          },
          "description": {
              "en": "desc en",
              "es": "desc es"
          },
          "brand": 1
      }
    """

  Scenario: Retrieve created routing pattern
    Given I add Brand Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "routing_patterns/3"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be like:
    """
      {
          "prefix": "+349",
          "id": 3,
          "name": {
              "en": "Spain",
              "es": "España"
          },
          "description": {
              "en": "desc en",
              "es": "desc es"
          },
          "brand": "~"
      }
    """

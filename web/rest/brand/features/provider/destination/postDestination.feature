  Feature: Create destination
  In order to manage destination
  As an super admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create a destination
    Given I add Brand Authorization header
    When I add "Content-Type" header equal to "application/json"
    And I add "Accept" header equal to "application/json"
    And I send a "POST" request to "/destinations" with body:
    """
      {
          "prefix": "+49",
          "name": {
              "en": "Germany",
              "es": "Alemania"
          }
      }
    """
    Then the response status code should be 201
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      {
          "prefix": "+49",
          "id": 3,
          "name": {
              "en": "Germany",
              "es": "Alemania"
          },
          "brand": 1
      }
    """

  Scenario: Retrieve created destination
    Given I add Brand Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "destinations/2"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be like:
    """
      {
          "prefix": "+94601",
          "id": 2,
          "name": {
              "en": "Usansolocity",
              "es": "Usansolocity"
          },
          "brand": "~"
      }
    """

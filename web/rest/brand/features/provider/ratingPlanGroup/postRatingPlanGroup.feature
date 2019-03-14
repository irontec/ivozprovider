  Feature: Create rating plan group
  In order to manage rating plan group
  As an super admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create a rating plan group
    Given I add Brand Authorization header
    When I add "Content-Type" header equal to "application/json"
    And I add "Accept" header equal to "application/json"
    And I send a "POST" request to "/rating_plan_groups" with body:
    """
      {
          "name": {
              "en": "New",
              "es": "Nuevo"
          },
          "description": {
              "en": "New Rating plan",
              "es": "Nuevo Rating plan"
          },
          "brand": "1"
      }
    """
    Then the response status code should be 201
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      {
          "id": 3,
          "name": {
              "en": "New",
              "es": "Nuevo"
          },
          "description": {
              "en": "New Rating plan",
              "es": "Nuevo Rating plan"
          },
          "brand": 1,
          "currency": null
      }
    """

  Scenario: Retrieve created rating plan group
    Given I add Brand Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "rating_plan_groups/2"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be like:
    """
      {
          "id": 2,
          "name": {
              "en": "Something more",
              "es": "Algo m\u00e1s"
          },
          "description": {
              "en": "",
              "es": ""
          },
          "brand": "~",
          "currency": null
      }
    """

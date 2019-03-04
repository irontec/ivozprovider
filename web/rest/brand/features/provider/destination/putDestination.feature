Feature: Update destination
  In order to manage destination
  As an super admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update a destination
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/destinations/1" with body:
    """
      {
          "prefix": "+94600",
          "id": 1,
          "name": {
              "en": "Bilbao Updated",
              "es": "Bilbao Actualizado"
          }
      }
    """
    Then the response status code should be 200
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be like:
    """
      {
          "prefix": "+94600",
          "id": 1,
          "name": {
              "en": "Bilbao Updated",
              "es": "Bilbao Actualizado"
          },
          "brand": "~"
      }
    """

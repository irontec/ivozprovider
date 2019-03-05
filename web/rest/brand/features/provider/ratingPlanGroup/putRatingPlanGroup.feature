Feature: Update rating plan group
  In order to manage rating plan group
  As an super admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update a rating plan group
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/rating_plan_groups/1" with body:
    """
      {
          "id": 1,
          "name": {
              "en": "Updated",
              "es": "Actualizado"
          },
          "description": {
              "en": "",
              "es": ""
          },
          "brand": "1",
          "currency": null
      }
    """
    Then the response status code should be 200
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be like:
    """
      {
          "id": 1,
          "name": {
              "en": "Updated",
              "es": "Actualizado"
          },
          "description": {
              "en": "",
              "es": ""
          },
          "brand": "~",
          "currency": null
      }
    """

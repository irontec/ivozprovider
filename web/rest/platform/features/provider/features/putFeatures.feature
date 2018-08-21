Feature: Update features
  In order to manage features
  As an super admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update an features
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/features/1" with body:
    """
      {
          "iden": "updatedQueues",
          "name": {
              "en": "name",
              "es": "nombre"
          }
      }
    """
    Then the response status code should be 200
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be equal to:
    """
      {
          "iden": "updatedQueues",
          "id": 1,
          "name": {
              "en": "name",
              "es": "nombre"
          }
      }
    """

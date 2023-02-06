Feature: Create features
  In order to manage features
  as a super admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create an features
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/features" with body:
      """
      {
          "iden": "newFeature",
          "name": {
              "en": "name",
              "es": "nombre",
              "ca": "nombre",
              "it": "nome"
          }
      }
      """
     Then the response status code should be 201
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      {
          "iden": "newFeature",
          "id": 10,
          "name": {
              "en": "name",
              "es": "nombre",
              "ca": "nombre",
              "it": "nome"
          }
      }
      """

  Scenario: Retrieve created features
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "features/10"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      {
          "iden": "newFeature",
          "id": 10,
          "name": {
              "en": "name",
              "es": "nombre",
              "ca": "nombre",
              "it": "nome"
          }
      }
      """

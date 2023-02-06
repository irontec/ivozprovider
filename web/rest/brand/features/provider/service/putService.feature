Feature: Update service
  In order to manage services
  As a brand admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update a services
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/services/1" with body:
      """
      {
          "iden": "UpdatedService",
          "defaultCode": "91",
          "extraArgs": true,
          "id": 1,
          "name": {
              "en": "en",
              "es": "en",
              "ca": "ca",
              "it": "it"
          },
          "description": {
              "en": "en",
              "es": "en",
              "ca": "ca",
              "it": "it"
          }
      }
      """
     Then the response status code should be 405

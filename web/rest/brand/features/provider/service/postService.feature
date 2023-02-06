Feature: Create services
  In order to manage services
  As a brand admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create a service
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/service" with body:
      """
      {
          "iden": "testService",
          "defaultCode": "91",
          "extraArgs": true,
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
     Then the response status code should be 404

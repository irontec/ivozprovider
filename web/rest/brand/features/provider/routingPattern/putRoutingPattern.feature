Feature: Update routing patterns
  In order to manage routing patterns
  As a brand admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update a routing pattern
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/routing_patterns/1" with body:
      """
      {
          "prefix": "+349",
          "name": {
              "en": "englishName",
              "es": "nombreEspañol",
              "ca": "nombreCatala",
              "it": "nomeItaliano"
          },
          "description": {
              "en": "en",
              "es": "es",
              "ca": "ca",
              "it": "it"
          }
      }
      """
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
      """
      {
          "prefix": "+349",
          "id": 1,
          "name": {
              "en": "englishName",
              "es": "nombreEspañol",
              "ca": "nombreCatala",
              "it": "nomeItaliano"
          },
          "description": {
              "en": "en",
              "es": "es",
              "ca": "ca",
              "it": "it"
          }
      }
      """

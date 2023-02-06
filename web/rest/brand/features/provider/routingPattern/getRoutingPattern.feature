Feature: Retrieve routing patterns
  In order to manage routing patterns
  As a brand admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the routing patterns json list
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "routing_patterns"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      [
          {
              "prefix": "+34",
              "id": 1,
              "name": {
                  "en": "en",
                  "es": "es",
                  "ca": "ca",
                  "it": "it"
              }
          },
          {
              "prefix": "+35",
              "id": 2,
              "name": {
                  "en": "en",
                  "es": "es",
                  "ca": "ca",
                  "it": "it"
              }
          }
      ]
      """

  Scenario: Retrieve certain routing pattern json
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "routing_patterns/1"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
      """
      {
          "prefix": "+34",
          "id": 1,
          "name": {
              "en": "en",
              "es": "es",
              "ca": "ca",
              "it": "it"
          },
          "description": {
              "en": "en",
              "es": "es",
              "ca": "ca",
              "it": "it"
          }
      }
      """

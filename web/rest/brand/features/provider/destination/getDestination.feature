Feature: Retrieve destination
  In order to manage destination
  As a brand admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the destination json list
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "destinations"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      [
          {
              "prefix": "+94600",
              "id": 1,
              "name": {
                  "en": "Bilbao",
                  "es": "Bilbao",
                  "ca": "Bilbao",
                  "it": "Bilbao"
              }
          },
          {
              "prefix": "+94602",
              "id": 3,
              "name": {
                  "en": "Dest3",
                  "es": "Dest3",
                  "ca": "Dest3",
                  "it": "Dest3"
              }
          },
          {
              "prefix": "+94601",
              "id": 2,
              "name": {
                  "en": "Usansolocity",
                  "es": "Usansolocity",
                  "ca": "Usansolocity",
                  "it": "Usansolocity"
              }
          }
      ]
      """

  Scenario: Retrieve certain destination json
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "destinations/1"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
      """
      {
          "prefix": "+94600",
          "id": 1,
          "name": {
              "en": "Bilbao",
              "es": "Bilbao",
              "ca": "Bilbao",
              "it": "Bilbao"
          }
      }
      """

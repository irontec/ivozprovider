Feature: Retrieve rating plan groups
  In order to manage rating plan groups
  As a client admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the rating plan groups json list
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "rating_plan_groups"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      [
          {
              "id": 1,
              "name": {
                  "en": "Something",
                  "es": "Algo",
                  "ca": "Algo mes",
                  "it": "Pi\u00f9"
              }
          },
          {
              "id": 2,
              "name": {
                  "en": "Something more",
                  "es": "Algo m\u00e1s",
                  "ca": "Algo mes",
                  "it": "Pi\u00f9"
              }
          }
      ]
      """

  Scenario: Retrieve certain rating plan group json
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "rating_plan_groups/1"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      {
          "id": 1,
          "name": {
              "en": "Something",
              "es": "Algo",
              "ca": "Algo mes",
              "it": "Pi\u00f9"
          },
          "description": {
              "en": "en",
              "es": "es",
              "ca": "ca",
              "it": "it"
          }
      }
      """

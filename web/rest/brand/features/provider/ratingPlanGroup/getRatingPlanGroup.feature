Feature: Retrieve rating plan group
  In order to manage rating plan group
  As a brand admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the rating plan group json list
    Given I add Brand Authorization header
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
                  "it": "Più"
              },
              "description": {
                  "en": "en",
                  "es": "es",
                  "ca": "ca",
                  "it": "it"
              },
              "currency": 1
          },
          {
              "id": 2,
              "name": {
                  "en": "Something more",
                  "es": "Algo más",
                  "ca": "Algo mes",
                  "it": "Più"
              },
              "description": {
                  "en": "en",
                  "es": "es",
                  "ca": "ca",
                  "it": "it"
              },
              "currency": 1
          }
      ]
      """

  Scenario: Retrieve certain rating plan group json
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "rating_plan_groups/1"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
      """
      {
          "id": 1,
          "name": {
              "en": "Something",
              "es": "Algo",
              "ca": "Algo mes",
              "it": "Più"
          },
          "description": {
              "en": "en",
              "es": "es",
              "ca": "ca",
              "it": "it"
          }
      }
      """

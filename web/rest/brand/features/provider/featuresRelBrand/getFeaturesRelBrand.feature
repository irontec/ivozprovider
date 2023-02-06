Feature: Retrieve features rel brand
  In order to manage features rel brand
  As an brand admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the features json list
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "features_rel_brands"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      [
          {
              "id": 1,
              "feature": 1
          },
          {
              "id": 2,
              "feature": 2
          },
          {
              "id": 3,
              "feature": 3
          },
          {
              "id": 4,
              "feature": 4
          },
          {
              "id": 5,
              "feature": 5
          },
          {
              "id": 6,
              "feature": 6
          },
          {
              "id": 7,
              "feature": 7
          }
      ]
      """

  Scenario: Retrieve certain feature json
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "features_rel_brands/1"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      {
          "id": 1,
          "feature": {
              "iden": "queues",
              "id": 1,
              "name": {
                  "en": "en",
                  "es": "es",
                  "ca": "ca",
                  "it": "it"
              }
          }
      }
      """

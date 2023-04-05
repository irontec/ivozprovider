Feature: Retrieve features rel companies
  In order to manage features rel companies
  As a client admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the features rel companies json list
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "features_rel_companies"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
      """
      [
          {
              "id": 1,
              "feature": {
                  "iden": "queues",
                  "id": 1,
                  "name": {
                      "en": "en",
                      "es": "es",
                      "ca": "ca"
                  }
              }
          },
          {
              "id": 2,
              "feature": {
                  "iden": "recordings",
                  "id": 2,
                  "name": {
                      "en": "en",
                      "es": "es",
                      "ca": "ca"
                  }
              }
          },
          {
              "id": 3,
              "feature": {
                  "iden": "faxes",
                  "id": 3,
                  "name": {
                      "en": "en",
                      "es": "es",
                      "ca": "ca"
                  }
              }
          },
          {
              "id": 4,
              "feature": {
                  "iden": "friends",
                  "id": 4,
                  "name": {
                      "en": "en",
                      "es": "es",
                      "ca": "ca"
                  }
              }
          },
          {
              "id": 5,
              "feature": {
                  "iden": "conferences",
                  "id": 5,
                  "name": {
                      "en": "en",
                      "es": "es",
                      "ca": "ca"
                  }
              }
          }
      ]
      """

  Scenario: Retrieve certain features rel company json
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "features_rel_companies/1"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
      """
      {
          "id": 1,
          "feature": {
              "iden": "queues",
              "id": 1,
              "name": {
                  "en": "en",
                  "es": "es",
                  "ca": "ca"
              }
          }
      }
      """

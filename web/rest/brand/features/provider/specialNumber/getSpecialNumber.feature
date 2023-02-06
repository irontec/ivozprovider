Feature: Retrieve special numbers
  In order to manage special numbers
  as a brand admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the special numbers json list
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "special_numbers"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      [
          {
              "number": "016",
              "disableCDR": 1,
              "id": 1,
              "country": 68,
              "global": true
          },
          {
              "number": "091",
              "disableCDR": 1,
              "id": 2,
              "country": 68,
              "global": false
          }
      ]
      """

  Scenario: Retrieve certain special number json
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "special_numbers/2"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      {
          "number": "091",
          "disableCDR": 1,
          "id": 2,
          "country": {
              "code": "ES",
              "countryCode": "+34",
              "id": 68,
              "name": {
                  "en": "Spain",
                  "es": "Espa\u00f1a",
                  "ca": "Espa\u00f1a",
                  "it": "Spagna"
              },
              "zone": {
                  "en": "Europe",
                  "es": "Europa",
                  "ca": "Europa",
                  "it": "Europe"
              }
          },
          "global": false
      }
      """

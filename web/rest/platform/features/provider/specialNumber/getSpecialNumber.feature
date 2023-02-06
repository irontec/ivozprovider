Feature: Retrieve special numbers
  In order to manage special numbers
  as a super admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the special numbers json list
    Given I add Authorization header
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
              "country": 68
          }
      ]
      """

  Scenario: Retrieve certain special number json
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "special_numbers/1"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      {
          "number": "016",
          "disableCDR": 1,
          "id": 1,
          "country": {
              "code": "ES",
              "countryCode": "+34",
              "id": 68,
              "name": {
                  "en": "Spain",
                  "es": "España",
                  "ca": "España",
                  "it": "Spagna"
              },
              "zone": {
                  "en": "Europe",
                  "es": "Europa",
                  "ca": "Europa",
                  "it": "Europe"
              }
          }
      }
      """

Feature: Create special numbers
  In order to manage special numbers
  as a brand admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create a special number
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/special_numbers" with body:
      """
      {
          "number": "118",
          "disableCDR": 1,
          "country": 68
      }
      """
     Then the response status code should be 201
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      {
          "number": "118",
          "disableCDR": 1,
          "id": 3,
          "country": 68,
          "global": false
      }
      """

  Scenario: Retrieve created special number
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "/special_numbers/3"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      {
          "number": "118",
          "disableCDR": 1,
          "id": 3,
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
          },
          "global": false
      }
      """

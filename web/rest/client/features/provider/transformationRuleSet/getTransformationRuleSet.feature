Feature: Retrieve transformation rule sets
  In order to manage transformation rule sets
  As a client admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the transformation rule sets json list
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "transformation_rule_sets"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      [
          {
              "description": "Brand 1 transformation for Spain",
              "internationalCode": "00",
              "trunkPrefix": "",
              "areaCode": "",
              "nationalLen": 9,
              "id": 1,
              "name": {
                  "en": "Brand 1 transformation for Spain",
                  "es": "Marca 1 tansformacion para España",
                  "ca": "Marca 1 tansformacion para España",
                  "it": "Brand 1 transformation for Spain"
              }
          },
          {
              "description": "Generic transformation for Spain",
              "internationalCode": "00",
              "trunkPrefix": "",
              "areaCode": "",
              "nationalLen": 9,
              "id": 3,
              "name": {
                  "en": "Generic transformation for Spain",
                  "es": "Generic tansformacion para España",
                  "ca": "Generic tansformacion para España",
                  "it": "Generic transformation for Spain"
              }
          }
      ]
      """

  Scenario: Retrieve certain transformation rule set json
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "transformation_rule_sets/1"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
      """
      {
          "description": "Brand 1 transformation for Spain",
          "internationalCode": "00",
          "trunkPrefix": "",
          "areaCode": "",
          "nationalLen": 9,
          "generateRules": false,
          "id": 1,
          "name": {
              "en": "Brand 1 transformation for Spain",
              "es": "Marca 1 tansformacion para España",
              "ca": "Marca 1 tansformacion para España",
              "it": "Brand 1 transformation for Spain"
          },
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

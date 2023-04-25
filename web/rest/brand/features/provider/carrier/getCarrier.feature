Feature: Retrieve carriers
  In order to manage carriers
  As a brand admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the carriers json list
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "carriers"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      [
          {
              "description": "Another carrier description",
              "name": "AnotherCarrierName",
              "balance": 0,
              "calculateCost": false,
              "id": 2,
              "transformationRuleSet": 1,
              "proxyTrunk": 2,
              "status": {
                  "registered": false
              }
          },
          {
              "description": "CarrierDescription",
              "name": "CarrierName",
              "balance": 0,
              "calculateCost": true,
              "id": 1,
              "transformationRuleSet": 1,
              "proxyTrunk": 1,
              "status": {
                  "registered": false
              }
          }
      ]
      """

  Scenario: Retrieve certain carrier json
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "carriers/1"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
      """
      {
          "description": "CarrierDescription",
          "name": "CarrierName",
          "calculateCost": true,
          "id": 1,
          "transformationRuleSet": {
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
              "country": 68,
              "editable": true
          }
      }
      """

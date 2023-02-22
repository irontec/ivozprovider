Feature: Modify carrier balances
  In order to manage carrier balances
  As a brand admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Increment a carrier balance
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/x-www-form-urlencoded"
      And I add "Accept" header equal to "application/json"
     When I send a "POST" request to "/carrier/2/modify_balance" with parameters:
      | key       | value     |
      | operation | increment |
      | amount    | 10        |
     Then the response status code should be 201
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
      """
      {
          "description": "Externally rated",
          "name": "ExternallyRatedCarrier",
          "externallyRated": true,
          "balance": 10,
          "calculateCost": false,
          "id": 2,
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
          },
          "currency": null,
          "proxyTrunk": {
              "name": "ExtraIP",
              "ip": "127.0.0.3",
              "id": 2
          }
      }
      """

  Scenario: Decrement a carrier balance
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/x-www-form-urlencoded"
      And I add "Accept" header equal to "application/json"
     When I send a "POST" request to "/carrier/1/modify_balance" with parameters:
      | key       | value     |
      | operation | decrement |
      | amount    | 10        |
     Then the response status code should be 201
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
      """
      {
          "description": "CarrierDescription",
          "name": "CarrierName",
          "externallyRated": false,
          "balance": -10,
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
          },
          "currency": null,
          "proxyTrunk": {
              "name": "proxytrunks",
              "ip": "127.0.0.1",
              "id": 1
          }
      }
      """

Feature: Retrieve ddi providers
  In order to manage ddi providers
  As a brand admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the ddi providers json list
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "ddi_providers"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      [
          {
              "description": "DDIProviderDescription",
              "name": "DDIProviderName",
              "id": 1,
              "transformationRuleSet": 1,
              "proxyTrunk": 1
          }
      ]
      """

  Scenario: Retrieve certain ddi provider json
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "ddi_providers/1"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
      """
      {
          "description": "DDIProviderDescription",
          "name": "DDIProviderName",
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
          "routingTag": "~"
      }
      """

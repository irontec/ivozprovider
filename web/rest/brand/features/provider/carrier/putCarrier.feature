Feature: Update carriers
  In order to manage carriers
  As an super admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update a carrier
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/carriers/1" with body:
    """
      {
          "description": "Artemis-Updated",
          "name": "Artemis-Updated",
          "externallyRated": true,
          "brand": 1,
          "transformationRuleSet": 2
      }
    """
    Then the response status code should be 200
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be like:
    """
         {
          "description": "Artemis-Updated",
          "name": "Artemis-Updated",
          "externallyRated": true,
          "balance": 0,
          "calculateCost": false,
          "id": 1,
          "brand": "~",
          "transformationRuleSet": {
              "description": "",
              "internationalCode": "00",
              "trunkPrefix": "",
              "areaCode": "",
              "nationalLen": 9,
              "generateRules": false,
              "id": 2,
              "name": {
                  "en": "en",
                  "es": "es"
              },
              "brand": 1,
              "country": 1
          }
      }
    """

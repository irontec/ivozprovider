Feature: Create carriers
  In order to manage carriers
  As an super admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create a carriers
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/carriers" with body:
    """
      {
          "description": "Artemis-New",
          "name": "Artemis-New",
          "externallyRated": false,
          "brand": 1,
          "transformationRuleSet": 1
      }
    """
    Then the response status code should be 201
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be equal to:
    """
      {
          "description": "Artemis-New",
          "name": "Artemis-New",
          "externallyRated": false,
          "balance": 0,
          "calculateCost": false,
          "id": 2,
          "brand": 1,
          "transformationRuleSet": 1,
          "currency": null
      }
    """

  Scenario: Retrieve created carrier
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "/carriers/2"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
    """
      {
          "description": "Artemis-New",
          "name": "Artemis-New",
          "externallyRated": false,
          "calculateCost": false,
          "id": 2,
          "brand": "~",
          "transformationRuleSet": {
              "description": "Generic transformation for Spain",
              "internationalCode": "00",
              "trunkPrefix": "",
              "areaCode": "",
              "nationalLen": 9,
              "generateRules": false,
              "id": 1,
              "name": {
                  "en": "en",
                  "es": "es"
              },
              "brand": null,
              "country": 1
          }
      }
    """

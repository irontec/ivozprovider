Feature: Retrieve carriers
  In order to manage carriers
  As an super admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the carriers json list
    Given I add Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "carriers"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      [
          {
              "description": "CarrierDescription",
              "name": "CarrierName",
              "externallyRated": false,
              "id": 1
          }
      ]
    """

  Scenario: Retrieve certain carrier json
    Given I add Authorization header
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
          "externallyRated": false,
          "calculateCost": false,
          "id": 1,
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

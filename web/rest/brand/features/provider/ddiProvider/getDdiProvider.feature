Feature: Retrieve ddi providers
  In order to manage ddi providers
  As an super admin
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
              "id": 1
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

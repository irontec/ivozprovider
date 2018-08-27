Feature: Create ddi providers
  In order to manage ddi providers
  As an super admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create a ddi providers
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/ddi_providers" with body:
    """
      {
          "description": "NewDDIProviderDescription",
          "name": "NewDDIProviderName",
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
          "description": "NewDDIProviderDescription",
          "name": "NewDDIProviderName",
          "id": 2
      }
    """

  Scenario: Retrieve created ddi provider
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "/ddi_providers/2"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
    """
      {
          "description": "NewDDIProviderDescription",
          "name": "NewDDIProviderName",
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

Feature: Update ddi providers
  In order to manage ddi providers
  As an super admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update a ddi provider
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/ddi_providers/1" with body:
    """
      {
          "description": "UpdateDDIProviderDescription",
          "name": "UpdateDDIProviderName",
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
        "description": "UpdateDDIProviderDescription",
        "name": "UpdateDDIProviderName",
        "externallyRated": false,
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

Feature: Update ddi providers
  In order to manage ddi providers
  As a brand admin
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
          "proxyTrunk": 1,
          "transformationRuleSet": 1
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
                    "es": "es",
                    "ca": "ca",
                    "it": "it"
                },
                "country": 68
            },
            "proxyTrunk": {
                "name": "proxytrunks",
                "ip": "127.0.0.1",
                "id": 1
            }
        }
    """

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
          "transformationRuleSet": 1,
          "routingTag": 2
      }
      """
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      {
            "description": "UpdateDDIProviderDescription",
            "name": "UpdateDDIProviderName",
            "id": 1,
            "transformationRuleSet": 1,
            "proxyTrunk": 1,
            "mediaRelaySet": 0,
            "routingTag": 2
        }
      """

  @createSchema
  Scenario: Update a ddi provider with unrelated media rely set
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/ddi_providers/1" with body:
      """
      {
          "description": "UpdateDDIProviderDescription",
          "name": "UpdateDDIProviderName",
          "proxyTrunk": 1,
          "transformationRuleSet": 1,
          "mediaRelaySet": 2
      }
      """
     Then the response status code should be 403
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/problem+json; charset=utf-8"
      And the JSON should be like:
      """
      {
          "detail": "Rejected request during security check"
      }
      """

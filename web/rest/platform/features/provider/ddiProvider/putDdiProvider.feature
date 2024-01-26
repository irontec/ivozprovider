Feature: Update ddi providers
  In order to manage ddi providers
  as a super admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update a ddi provider
    Given I add Authorization header
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
     Then the response status code should be 404

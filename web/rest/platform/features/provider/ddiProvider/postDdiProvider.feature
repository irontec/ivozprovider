Feature: Create ddi providers
  In order to manage ddi providers
  as a super admin
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
          "proxyTrunk": 1,
          "transformationRuleSet": 1
      }
      """
     Then the response status code should be 405

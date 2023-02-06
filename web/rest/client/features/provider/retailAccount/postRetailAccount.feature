Feature: Create retail accounts
  In order to manage retail accounts
  As a client admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create a retail account
    Given I add Retail Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/retail_accounts" with body:
      """
      {
          "name": "testPostResidential",
          "description": "",
          "transformationRuleSet": 1,
          "outgoingDdi": 1,
          "transport": "udp",
          "password": "ky7rVWX99_"
      }
      """
     Then the response status code should be 405

Feature: Create retail accounts
  In order to manage retail accounts
  As a client admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create a retail account
    Given I add Company Authorization header
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
          "password": "ky7rVWX99_",
          "company": 1
      }
    """
    Then the response status code should be 201
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be equal to:
    """
      {
          "name": "testPostResidential",
          "description": "",
          "transport": "udp",
          "password": "ky7rVWX99_",
          "id": 2,
          "company": 1,
          "transformationRuleSet": 1,
          "outgoingDdi": 1
      }
    """

  Scenario: Retrieve created retail account
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "retail_accounts/2"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
    """
      {
          "name": "testPostResidential",
          "description": "",
          "transport": "udp",
          "password": "ky7rVWX99_",
          "id": 2,
          "company": "~",
          "transformationRuleSet": "~",
          "outgoingDdi": "~"
      }
    """

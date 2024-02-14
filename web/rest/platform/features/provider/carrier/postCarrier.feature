Feature: Create carriers
  In order to manage carriers
  as a super admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create a carriers
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/carriers" with body:
      """
      {
          "description": "Artemis-New",
          "name": "Artemis-New",
          "proxyTrunk": 1,
          "transformationRuleSet": 1
      }
      """
     Then the response status code should be 405

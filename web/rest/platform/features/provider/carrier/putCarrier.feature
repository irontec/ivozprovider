Feature: Update carriers
  In order to manage carriers
  as a super admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update a carrier
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/carriers/1" with body:
      """
      {
          "description": "Artemis-Updated",
          "name": "Artemis-Updated",
          "transformationRuleSet": 1
      }
      """
     Then the response status code should be 404

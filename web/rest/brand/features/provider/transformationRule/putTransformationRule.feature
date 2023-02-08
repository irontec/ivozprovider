Feature: Update transformation rules
  In order to manage transformation rules
  As a brand admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update a transformation rule
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/transformation_rules/4" with body:
      """
      {
          "type": "callerin",
          "description": "Updated",
          "priority": 5,
          "matchExpr": "^([0-9]+)$",
          "replaceExpr": "+34\u0001",
          "transformationRuleSet": 1
      }
      """
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
       {
          "type": "callerin",
          "description": "Updated",
          "priority": 5,
          "matchExpr": "^([0-9]+)$",
          "replaceExpr": "+34\u0001",
          "id": 4,
          "transformationRuleSet": 1
      }
      """

  Scenario: Cannot update generic tranformation rule set value
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/transformation_rules/4" with body:
      """
      {
          "transformationRuleSet": 2
      }
      """
     Then the response status code should be 403

Feature: Manage transformation rule sets
  In order to manage transformation rule sets
  As an super admin
  I need to be able to delete them through the API.

  @createSchema
  Scenario: Remove a transformation rule set
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "DELETE" request to "/transformation_rule_sets/2"
     Then the response status code should be 204

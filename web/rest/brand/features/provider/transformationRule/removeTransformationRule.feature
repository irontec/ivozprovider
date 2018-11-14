Feature: Manage transformation rules
  In order to manage transformation rules
  As an super admin
  I need to be able to delete them through the API.

  @createSchema
  Scenario: Remove a transformation rule
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "DELETE" request to "/transformation_rules/5"
     Then the response status code should be 204

  @createSchema
  Scenario: Cannot remove unmanaged transformation rule
    Given I add Brand Authorization header
    When I add "Content-Type" header equal to "application/json"
    And I add "Accept" header equal to "application/json"
    And I send a "DELETE" request to "/transformation_rules/1"
    Then the response status code should be 404
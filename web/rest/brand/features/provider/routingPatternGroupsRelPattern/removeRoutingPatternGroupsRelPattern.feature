Feature: Manage routing pattern groups rel patterns
  In order to manage routing pattern groups rel patterns
  As an super admin
  I need to be able to delete them through the API.

  @createSchema
  Scenario: Remove a routing pattern groups rel pattern
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "DELETE" request to "/routing_pattern_groups_rel_patterns/1"
     Then the response status code should be 204

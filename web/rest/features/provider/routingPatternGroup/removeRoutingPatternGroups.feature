Feature: Manage routing pattern groups
  In order to manage routing pattern groups
  As an super admin
  I need to be able to delete them through the API.

  @createSchema
  Scenario: Remove a routing pattern group
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "DELETE" request to "/routing_pattern_groups/1"
     Then the response status code should be 204

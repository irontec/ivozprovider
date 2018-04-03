Feature: Manage routing patterns
  In order to manage routing patterns
  As an super admin
  I need to be able to delete them through the API.

  @createSchema
  Scenario: Remove a routing pattern
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "DELETE" request to "/routing_patterns/1"
     Then the response status code should be 204

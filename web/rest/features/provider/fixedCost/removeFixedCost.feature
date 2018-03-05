Feature: Manage fixed costs
  In order to manage fixed costs
  As an super admin
  I need to be able to delete them through the API.

  @createSchema
  Scenario: Remove a fixed cost
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "DELETE" request to "/fixed_costs/1"
     Then the response status code should be 204
Feature: Manage hunt groups
  In order to manage hunt groups
  As an super admin
  I need to be able to delete them through the API.

  @createSchema
  Scenario: Remove a hunt group
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "DELETE" request to "/hunt_groups/1"
     Then the response status code should be 204
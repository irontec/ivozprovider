Feature: Manage hunt groups rel users
  In order to manage hunt groups rel users
  As an super admin
  I need to be able to delete them through the API.

  @createSchema
  Scenario: Remove a hunt group rel user
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "DELETE" request to "/hunt_groups_rel_users/1"
     Then the response status code should be 204
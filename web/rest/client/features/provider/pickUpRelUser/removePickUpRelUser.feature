Feature: Manage pick up rel users
  In order to manage pick up rel users
  As an super admin
  I need to be able to delete them through the API.

  @createSchema
  Scenario: Remove a pick up rel user
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "DELETE" request to "/pick_up_rel_users/1"
     Then the response status code should be 204

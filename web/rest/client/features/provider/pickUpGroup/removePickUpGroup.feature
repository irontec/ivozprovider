Feature: Manage pick up groups
  In order to manage pick up groups
  As an super admin
  I need to be able to delete them through the API.

  @createSchema
  Scenario: Remove a pick up group
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "DELETE" request to "/pick_up_groups/1"
     Then the response status code should be 204

Feature: Manage queue members
  In order to manage queue members
  As an super admin
  I need to be able to delete them through the API.

  @createSchema
  Scenario: Remove a queue member
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "DELETE" request to "/queue_members/1"
     Then the response status code should be 204

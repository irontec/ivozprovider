Feature: Manage conference rooms
  In order to manage conference rooms
  As an super admin
  I need to be able to delete them through the API.

  @createSchema
  Scenario: Remove a conference room
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "DELETE" request to "/conference_rooms/1"
     Then the response status code should be 204
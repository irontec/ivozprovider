Feature: Manage music on holds
  In order to manage music on holds
  As an super admin
  I need to be able to delete them through the API.

  @createSchema
  Scenario: Remove a music on hold
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "DELETE" request to "/music_on_holds/1"
     Then the response status code should be 204
Feature: Manage outgoing routings
  In order to manage outgoing routings
  As an super admin
  I need to be able to delete them through the API.

  @createSchema
  Scenario: Remove a outgoing routing
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "DELETE" request to "/outgoing_routings/1"
     Then the response status code should be 204

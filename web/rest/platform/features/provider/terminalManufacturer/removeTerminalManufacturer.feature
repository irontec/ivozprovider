Feature: Manage terminal manufacturers
  In order to manage terminal manufacturers
  As an super admin
  I need to be able to delete them through the API.

  @createSchema
  Scenario: Remove a terminal manufacturers
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "DELETE" request to "/terminal_manufacturers/1"
     Then the response status code should be 204

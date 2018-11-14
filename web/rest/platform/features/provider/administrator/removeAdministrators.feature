Feature: Manage administrators
  In order to manage administrators
  As an super admin
  I need to be able to delete them through the API.

  @createSchema
  Scenario: Remove a administrator
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "DELETE" request to "/administrators/4"
     Then the response status code should be 204

  @createSchema
  Scenario: Administrator with id zero is filtered
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "DELETE" request to "/administrators/0"
     Then the response status code should be 404
Feature: Manage application server set
  In order to manage application server set
  as a super admin
  I need to be able to delete them through the API.

  @createSchema
  Scenario: Remove a application server set
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "DELETE" request to "/application_server_sets/1"
     Then the response status code should be 204

  @createSchema
  Scenario: application server set with id zero is readonly
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "DELETE" request to "/application_server_sets/0"
     Then the response status code should be 403

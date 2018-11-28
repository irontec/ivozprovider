Feature: Manage external call filters
  In order to manage external call filters
  As an super admin
  I need to be able to delete them through the API.

  @createSchema
  Scenario: Remove a external call filter
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "DELETE" request to "/external_call_filters/1"
     Then the response status code should be 204
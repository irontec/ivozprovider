Feature: Manage external call filter black lists
  In order to manage external call filter black lists
  As an super admin
  I need to be able to delete them through the API.

  @createSchema
  Scenario: Remove an external call filter black list
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "DELETE" request to "/external_call_filter_black_lists/1"
     Then the response status code should be 204
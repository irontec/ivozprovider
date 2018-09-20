Feature: Manage external call filter rel schedules
  In order to manage external call filter rel schedules
  As an super admin
  I need to be able to delete them through the API.

  @createSchema
  Scenario: Remove a external call filter rel schedule
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "DELETE" request to "/external_call_filter_rel_schedules/1"
     Then the response status code should be 204
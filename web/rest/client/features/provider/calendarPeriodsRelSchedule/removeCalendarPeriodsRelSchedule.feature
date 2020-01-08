Feature: Manage calendar periods rel schedules
  In order to manage calendar periods rel schedules
  As a client admin
  I need to be able to delete them through the API.

  @createSchema
  Scenario: Remove a calendar rel schedule
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "DELETE" request to "/calendar_periods_rel_schedules/1"
     Then the response status code should be 204

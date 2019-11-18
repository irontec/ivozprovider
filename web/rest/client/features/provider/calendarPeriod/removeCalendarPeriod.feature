Feature: Manage calendar periods
  In order to manage calendar periods
  As a client admin
  I need to be able to delete them through the API.

  @createSchema
  Scenario: Remove a calendar
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "DELETE" request to "/calendar_periods/1"
     Then the response status code should be 204

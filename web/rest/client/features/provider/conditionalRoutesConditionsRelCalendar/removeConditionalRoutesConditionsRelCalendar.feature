Feature: Manage conditional routes conditions rel calendars
  In order to manage conditional routes conditions rel calendars
  As an super admin
  I need to be able to delete them through the API.

  @createSchema
  Scenario: Remove a conditional routes conditions rel calendar
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "DELETE" request to "/conditional_routes_conditions_rel_calendars/1"
     Then the response status code should be 204
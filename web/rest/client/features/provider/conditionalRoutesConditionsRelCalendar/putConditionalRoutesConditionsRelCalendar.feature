Feature: Create conditional routes conditions rel calendars
  In order to manage conditional routes conditions rel calendars
  As a client admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Update a conditional routes conditions rel calendar
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/conditional_routes_conditions_rel_calendars/1" with body:
      """
      {
        "condition": 1,
        "calendar": 2
      }
      """
     Then the response status code should be 405

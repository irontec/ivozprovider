Feature: Create conditional routes conditions rel schedules
  In order to manage conditional routes conditions rel schedules
  As a client admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: updated a conditional routes conditions rel schedule
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/conditional_routes_conditions_rel_schedules/1" with body:
      """
      {
          "condition": 1,
          "schedule": 2
      }
      """
     Then the response status code should be 405

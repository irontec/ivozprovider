Feature: Create conditional routes conditions route lock
  In order to manage conditional routes conditions route lock
  As a client admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: updated a conditional routes conditions rel schedule
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/conditional_routes_conditions_rel_route_locks/1" with body:
      """
      {
          "condition": 1,
          "routeLock": 2
      }
      """
     Then the response status code should be 405

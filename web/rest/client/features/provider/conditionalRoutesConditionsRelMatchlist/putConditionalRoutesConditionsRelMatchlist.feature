Feature: Create conditional routes conditions rel matchlists
  In order to manage conditional routes conditions rel matchlists
  As a client admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Create an conditional routes conditions rel matchlists
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/conditional_routes_conditions_rel_matchlists/1" with body:
      """
      {
          "condition": 1,
          "matchlist": 2
      }
      """
     Then the response status code should be 405

Feature: Manage conditional routes conditions rel matchlists
  In order to manage conditional routes conditions rel matchlists
  As an super admin
  I need to be able to delete them through the API.

  @createSchema
  Scenario: Remove a conditional routes conditions rel matchlist
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "DELETE" request to "/conditional_routes_conditions_rel_matchlists/1"
     Then the response status code should be 204
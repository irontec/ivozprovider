Feature: Manage match list patterns
  In order to manage match list patterns
  As a client admin
  I need to be able to delete them through the API.

  @createSchema
  Scenario: Remove a match list pattern
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "DELETE" request to "/match_list_patterns/1"
     Then the response status code should be 204

  Scenario: Cannot remove a generic match list pattern
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "DELETE" request to "/match_list_patterns/2"
     Then the response status code should be 403

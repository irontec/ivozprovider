Feature: Manage match lists
  In order to manage match lists
  As a brand admin
  I need to be able to delete them through the API.

  @createSchema
  Scenario: Remove a match list
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "DELETE" request to "/match_lists/3"
     Then the response status code should be 204

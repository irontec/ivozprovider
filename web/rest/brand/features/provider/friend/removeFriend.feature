Feature: Manage friends
  In order to manage friends
  As a brand admin
  I need to be able to delete them through the API.

  @createSchema
  Scenario: Remove a friends
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "DELETE" request to "/friends/2"
     Then the response status code should be 204

  Scenario: Check that related friend 3 has also been removed
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "friends/3"
     Then the response status code should be 404

Feature: Manage users
  In order to manage users
  As a brand admin
  I need to be able to delete them through the API.

  @createSchema
  Scenario: Remove a user
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "DELETE" request to "/users/1"
     Then the response status code should be 404

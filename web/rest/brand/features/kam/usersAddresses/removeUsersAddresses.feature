Feature: Manage Users addresses
  In order to manage Users addresses
  As a brand admin
  I need to be able to delete them through the API.

  @createSchema
  Scenario: Remove a administrator
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "DELETE" request to "/users_addresses/1"
     Then the response status code should be 204

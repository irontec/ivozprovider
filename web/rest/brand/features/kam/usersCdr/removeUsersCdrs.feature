Feature: Manage users cdrs
  In order to manage users cdrs
  As a brand admin
  I need to be able to delete them through the API.

  @createSchema
  Scenario: Remove a administrator
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "DELETE" request to "/users_cdrs/1"
     Then the response status code should be 405

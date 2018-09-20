Feature: Manage proxy users
  In order to manage proxy users
  As an super admin
  I need to be able to delete them through the API.

  @createSchema
  Scenario: Remove a proxy user
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "DELETE" request to "/proxy_users/1"
     Then the response status code should be 204

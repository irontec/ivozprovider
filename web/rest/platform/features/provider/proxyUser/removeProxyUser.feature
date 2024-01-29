Feature: Manage proxy users
  In order to manage proxy users
  as a super admin
  I need to be able to delete them through the API.

  @createSchema
  Scenario: Cannot remove a proxy user with id 1
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "DELETE" request to "/proxy_users/1"
     Then the response status code should be 403

  @createSchema
  Scenario: Remove any proxy user with id != 1
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "DELETE" request to "/proxy_users/2"
     Then the response status code should be 204

Feature: Manage call acls
  In order to manage call acls
  As an super admin
  I need to be able to delete them through the API.

  @createSchema
  Scenario: Remove a call acl
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "DELETE" request to "/call_acls/1"
     Then the response status code should be 204
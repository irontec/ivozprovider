Feature: Manage call acl rel match lists
  In order to manage call acl rel match lists
  As an super admin
  I need to be able to delete them through the API.

  @createSchema
  Scenario: Remove a call acl rel match list
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "DELETE" request to "/call_acl_rel_match_lists/1"
     Then the response status code should be 204
Feature: Update call acls
  In order to manage call acls
  As an super admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update a call acl
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "call_acls/1" with body:
    """
       {
          "name": "updatedACL",
          "defaultPolicy": "deny",
          "company": 2
      }
    """
    Then the response status code should be 200
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be like:
    """
      {
          "name": "updatedACL",
          "defaultPolicy": "deny",
          "id": 1,
          "company": "~"
      }
    """

Feature: Create call acls
  In order to manage call acls
  As an super admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create an call acl
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "call_acls" with body:
    """
      {
          "name": "testNewACL",
          "defaultPolicy": "allow",
          "company": 1
      }
    """
    Then the response status code should be 201
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be equal to:
    """
      {
          "name": "testNewACL",
          "defaultPolicy": "allow",
          "id": 3,
          "company": 1
      }
    """

  Scenario: Retrieve created call acl
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "call_acls/3"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
    """
      {
          "name": "testNewACL",
          "defaultPolicy": "allow",
          "id": 3,
          "company": "~"
      }
    """

Feature: Retrieve call acls
  In order to manage call acls
  As an super admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the call acl json list
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "call_acls"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
      [
          {
              "name": "testACL",
              "defaultPolicy": "allow",
              "id": 1
          },
          {
              "name": "testACL2",
              "defaultPolicy": "deny",
              "id": 2
          }
      ]
    """

  Scenario: Retrieve certain call acl json
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "call_acls/1"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
    """
      {
          "name": "testACL",
          "defaultPolicy": "allow",
          "id": 1,
          "company": "~"
      }
    """

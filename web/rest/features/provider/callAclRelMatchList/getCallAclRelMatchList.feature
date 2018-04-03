Feature: Retrieve call acl rel match lists
  In order to manage call acl rel match lists
  As an super admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the call acl rel matchlist json list
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "call_acl_rel_match_lists"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
      [
          {
              "priority": 1,
              "policy": "allow",
              "id": 1,
              "callAcl": {
                  "name": "testACL",
                  "defaultPolicy": "allow",
                  "id": 1,
                  "company": 1
              },
              "matchList": {
                  "name": "testMatchlist",
                  "id": 1,
                  "brand": null,
                  "company": 1
              }
          }
      ]
    """

  Scenario: Retrieve certain call acl rel match list json
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "call_acl_rel_match_lists/1"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
      {
          "priority": 1,
          "policy": "allow",
          "id": 1,
          "callAcl": {
              "name": "testACL",
              "defaultPolicy": "allow",
              "id": 1,
              "company": 1
          },
          "matchList": {
              "name": "testMatchlist",
              "id": 1,
              "brand": null,
              "company": 1
          }
      }
    """

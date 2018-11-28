Feature: Create call acl rel match lists
  In order to manage call acl rel match lists
  As an super admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create a call acl rel match list
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "call_acl_rel_match_lists" with body:
    """
      {
          "priority": 2,
          "policy": "deny",
          "callAcl": 2,
          "matchList": 2
      }
    """
    Then the response status code should be 201
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be equal to:
    """
      {
          "priority": 2,
          "policy": "deny",
          "id": 2
      }
    """

  Scenario: Retrieve created call acl rel match list
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "call_acl_rel_match_lists/2"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
      {
          "priority": 2,
          "policy": "deny",
          "id": 2,
          "callAcl": {
              "name": "testACL2",
              "defaultPolicy": "deny",
              "id": 2,
              "company": 1
          },
          "matchList": {
              "name": "testMatchlist2",
              "id": 2,
              "company": 1
          }
      }
    """

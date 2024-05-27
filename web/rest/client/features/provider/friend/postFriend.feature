Feature: Create friends
  In order to manage friends
  As a client admin
  I should not be able to create them through the API.

  @createSchema
  Scenario: Create a friend
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/friends" with body:
      """
      {
          "name": "beWatterMyFriend",
          "description": "something",
          "transport": "tls",
          "ip": "129.1.2.3",
          "port": 5060,
          "password": "",
          "priority": 2,
          "allow": "alaw",
          "fromDomain": "",
          "directConnectivity": "intervpbx",
          "ddiIn": "yes",
          "t38Passthrough": "no",
          "transformationRuleSet": null,
          "callAcl": null,
          "outgoingDdi": null,
          "language": null,
          "interCompany": 1,
          "company": 1,
          "ruriDomain": "test.example.com"
      }
      """
     Then the response status code should be 405

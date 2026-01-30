Feature: Create friends
  In order to manage friends
  As a brand admin
  I need to be able to create them through the API.
  
  @createSchema
  Scenario: Create a friend
    Given I add Brand Authorization header
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
          "password": "ZEF7t5n+b4",
          "priority": 2,
          "allow": "alaw",
          "fromDomain": "",
          "directConnectivity": "yes",
          "ddiIn": "yes",
          "t38Passthrough": "no",
          "transformationRuleSet": null,
          "callAcl": null,
          "outgoingDdi": null,
          "language": null,
          "company": 1,
          "proxyUser": 1
      }
      """
     Then the response status code should be 201
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      {
          "name": "beWatterMyFriend",
          "description": "something",
          "priority": 3,
          "directConnectivity": "yes",
          "id": 4,
          "company": 1,
          "domain": 3,
          "interCompany": null,
          "proxyUser": 1
      }
      """

  Scenario: Retrieve created friends
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "friends/4"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
      """
      {
          "name": "beWatterMyFriend",
          "description": "something",
          "transport": "tls",
          "ip": "129.1.2.3",
          "port": 5060,
          "password": "ZEF7t5n+b4",
          "priority": 3,
          "directConnectivity": "yes",
          "id": 4,
          "company": "~",
          "interCompany": null,
          "ruriDomain": null,
          "proxyUser": {
              "id": 1,
              "*": "~"  
          }
      }
      """

  @createSchema
  Scenario: Create a friend with intervpbx connectivity
    Given I add Brand Authorization header
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
          "password": "ZEF7t5n+b4",
          "priority": 2,
          "allow": "alaw",
          "fromDomain": "",
          "directConnectivity": "yes",
          "ddiIn": "yes",
          "t38Passthrough": "no",
          "transformationRuleSet": null,
          "callAcl": null,
          "outgoingDdi": null,
          "language": null,
          "company": 2,
          "proxyUser": 1
      }
      """
     Then the response status code should be 201
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      {
          "name": "beWatterMyFriend",
          "description": "something",
          "priority": 3,
          "directConnectivity": "yes",
          "id": 4,
          "company": 2,
          "domain": 5,
          "interCompany": null,
          "proxyUser": 1
      }
      """

  Scenario: Retrieve created intervpbx friends pair
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "GET" request to "/friends?interCompany[]=1&interCompany[]=3"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      [
          {
              "name": "InterCompany1_2",
              "description": "",
              "priority": 2,
              "directConnectivity": "intervpbx",
              "id": 3,
              "company": 2,
              "domain": 5,
              "interCompany": 1,
              "proxyUser": null
          }
      ]
      """

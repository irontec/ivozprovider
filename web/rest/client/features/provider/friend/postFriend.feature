Feature: Create friends
  In order to manage friends
  As a client admin
  I need to be able to create them through the API.

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
          "company": 1
      }
      """
     Then the response status code should be 201
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      {
          "name": "InterCompany1_1",
          "description": "something",
          "transport": "tls",
          "ip": "129.1.2.3",
          "port": 5060,
          "password": null,
          "priority": 2,
          "allow": "alaw",
          "fromUser": null,
          "fromDomain": "127.0.0.1",
          "directConnectivity": "intervpbx",
          "ddiIn": "yes",
          "t38Passthrough": "no",
          "alwaysApplyTransformations": false,
          "rtpEncryption": false,
          "multiContact": true,
          "id": 3,
          "transformationRuleSet": null,
          "callAcl": null,
          "outgoingDdi": null,
          "language": null,
          "interCompany": 1
      }
      """

  Scenario: Retrieve created friends
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "friends/3"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
      """
      {
          "name": "InterCompany1_1",
          "description": "something",
          "transport": "tls",
          "ip": "129.1.2.3",
          "port": 5060,
          "password": null,
          "priority": 2,
          "allow": "alaw",
          "fromUser": null,
          "fromDomain": "127.0.0.1",
          "directConnectivity": "intervpbx",
          "ddiIn": "yes",
          "t38Passthrough": "no",
          "alwaysApplyTransformations": false,
          "rtpEncryption": false,
          "multiContact": true,
          "id": 3,
          "transformationRuleSet": null,
          "callAcl": null,
          "outgoingDdi": null,
          "language": null,
          "interCompany": {
            "type": "vpbx",
            "name": "DemoCompany",
            "domainUsers": "127.0.0.1",
            "onDemandRecordCode": "",
            "balance": 1.2,
            "id": 1
          }
      }
      """

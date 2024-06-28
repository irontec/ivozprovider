Feature: Update friends
  In order to manage friends
  As a client admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update a friend
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/friends/1" with body:
      """
      {
          "name": "updatedTestFriend",
          "description": "",
          "transport": "udp",
          "ip": "1.2.3.4",
          "port": 5061,
          "password": "",
          "priority": 1,
          "disallow": "all",
          "allow": "alaw",
          "directMediaMethod": "update",
          "calleridUpdateHeader": "pai",
          "updateCallerid": "yes",
          "fromDomain": "",
          "directConnectivity": "intervpbx",
          "id": 1,
          "callAcl": null,
          "outgoingDdi": null,
          "language": null,
          "interCompany": 1
      }
      """
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
      """
      {
          "name": "updatedTestFriend",
          "description": "",
          "transport": "udp",
          "ip": "1.2.3.4",
          "port": 5061,
          "password": null,
          "priority": 1,
          "allow": "alaw",
          "fromUser": null,
          "fromDomain": "",
          "directConnectivity": "yes",
          "ddiIn": "yes",
          "t38Passthrough": "no",
          "alwaysApplyTransformations": false,
          "rtpEncryption": false,
          "multiContact": true,
          "ruriDomain": null,
          "id": 1,
          "transformationRuleSet": null,
          "callAcl": null,
          "outgoingDdi": null,
          "language": null,
          "interCompany": null
      }
      """

  @createSchema
  Scenario: Update a friend with and invalid combination of values
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/friends/1" with body:
      """
      {
        "directConnectivity": "yes",
        "ip": null,
        "port": null,
        "ruriDomain": null
      }
      """
     Then the response status code should be 400

  @createSchema
  Scenario: Update a friend with ruriDomain
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/friends/1" with body:
      """
      {
        "directConnectivity": "yes",
        "ip": null,
        "port": null,
        "ruriDomain": "test.example.com"
      }
      """
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
      """
      {
        "id": 1,
        "directConnectivity": "yes",
        "ip": null,
        "port": null,
        "ruriDomain": "test.example.com"
      }
      """

  @createSchema
  Scenario: Update a friend without ruriDomain
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/friends/1" with body:
      """
      {
        "directConnectivity": "yes",
        "ip": "10.10.10.10",
        "port": "1010",
        "ruriDomain": null
      }
      """
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
      """
      {
        "id": 1,
        "directConnectivity": "yes",
        "ip": "10.10.10.10",
        "port": 1010,
        "ruriDomain": null
      }
      """

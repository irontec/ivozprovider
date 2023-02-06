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
          "password": "ZEF7t5n+b4",
          "priority": 1,
          "disallow": "all",
          "allow": "alaw",
          "directMediaMethod": "update",
          "calleridUpdateHeader": "pai",
          "updateCallerid": "yes",
          "fromDomain": "",
          "directConnectivity": "yes",
          "id": 1,
          "callAcl": null,
          "outgoingDdi": null,
          "language": null
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
          "password": "ZEF7t5n+b4",
          "priority": 1,
          "allow": "alaw",
          "fromDomain": "",
          "directConnectivity": "yes",
          "ddiIn": "yes",
          "t38Passthrough": "no",
          "id": 1,
          "transformationRuleSet": null,
          "callAcl": null,
          "outgoingDdi": null,
          "language": null
      }
      """

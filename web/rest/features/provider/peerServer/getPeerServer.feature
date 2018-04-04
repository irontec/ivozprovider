Feature: Retrieve peer servers
  In order to manage peer servers
  As an super admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the peer servers json list
    Given I add Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "peer_servers"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      [
          {
              "ip": null,
              "hostname": "127.0.0.1",
              "authNeeded": "no",
              "sipProxy": "127.0.0.1",
              "id": 1
          }
      ]
    """

  Scenario: Retrieve certain peer server json
    Given I add Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "peer_servers/1"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be like:
    """
      {
          "ip": null,
          "hostname": "127.0.0.1",
          "port": 5060,
          "params": "",
          "uriScheme": true,
          "transport": true,
          "strip": null,
          "prefix": "",
          "sendPAI": false,
          "sendRPID": false,
          "authNeeded": "no",
          "authUser": null,
          "authPassword": null,
          "sipProxy": "127.0.0.1",
          "outboundProxy": null,
          "fromUser": "",
          "fromDomain": "",
          "id": 1,
          "peeringContract": {
              "description": "Artemis-Dev",
              "name": "Artemis-Dev",
              "externallyRated": false,
              "id": 1,
              "brand": 1,
              "transformationRuleSet": 1
          },
          "brand": "~"
      }
    """

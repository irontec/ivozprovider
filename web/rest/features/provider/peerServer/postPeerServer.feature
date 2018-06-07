Feature: Create peer servers
  In order to manage peer servers
  As an super admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create a peer servers
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/peer_servers" with body:
    """
      {
          "ip": "127.0.0.2",
          "hostname": "newhost.net",
          "port": 5060,
          "uriScheme": 2,
          "transport": 1,
          "sendPAI": false,
          "sendRPID": false,
          "authNeeded": "no",
          "authUser": null,
          "authPassword": null,
          "sipProxy": "127.0.0.3",
          "outboundProxy": null,
          "fromUser": "",
          "fromDomain": "",
          "peeringContract": 1,
          "brand": 2
      }
    """
    Then the response status code should be 201
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be equal to:
    """
      {
          "ip": null,
          "hostname": "127.0.0.3",
          "authNeeded": "no",
          "sipProxy": "127.0.0.3",
          "id": 2
      }
    """

  Scenario: Retrieve created peer server
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "peer_servers/2"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
    """
      {
          "ip": null,
          "hostname": "127.0.0.3",
          "port": 5060,
          "uriScheme": 2,
          "transport": 1,
          "sendPAI": false,
          "sendRPID": false,
          "authNeeded": "no",
          "authUser": null,
          "authPassword": null,
          "sipProxy": "127.0.0.3",
          "outboundProxy": null,
          "fromUser": "",
          "fromDomain": "",
          "id": 2,
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

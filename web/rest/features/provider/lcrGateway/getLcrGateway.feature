Feature: Retrieve lcr gateways
  In order to manage lcr gateways
  As an super admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the lcr gateways json list
    Given I add Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "lcr_gateways"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      [
          {
              "lcrId": 1,
              "gwName": "b1p1s1",
              "ip": "127.0.0.1",
              "hostname": "hostname.net",
              "id": 1
          }
      ]
    """

  Scenario: Retrieve certain lcr gateway json
    Given I add Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "lcr_gateways/1"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      {
          "lcrId": 1,
          "gwName": "b1p1s1",
          "ip": "127.0.0.1",
          "hostname": "hostname.net",
          "port": 5060,
          "params": "",
          "uriScheme": true,
          "transport": true,
          "strip": null,
          "prefix": null,
          "tag": "1",
          "flags": 0,
          "defunct": null,
          "id": 1,
          "peerServer": {
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
              "lcrGateway": null,
              "peeringContract": 1,
              "brand": 1
          }
      }
    """

Feature: Retrieve lcr rule targets
  In order to manage lcr rule targets
  As an super admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the lcr rule targets json list
    Given I add Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "lcr_rule_targets"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      [
          {
              "lcrId": 1,
              "priority": 11,
              "weight": 6,
              "id": 1,
              "rule": {
                  "lcrId": 1,
                  "prefix": "+93",
                  "fromUri": "^b1c[0-9]+$",
                  "requestUri": null,
                  "stopper": 0,
                  "enabled": 1,
                  "tag": "Afghanistan",
                  "description": "",
                  "id": 1,
                  "routingPattern": 1,
                  "outgoingRouting": 2
              },
              "gw": {
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
                  "peerServer": 1
              },
              "outgoingRouting": {
                  "type": "pattern",
                  "priority": 11,
                  "weight": 6,
                  "id": 2,
                  "brand": 1,
                  "company": null,
                  "peeringContract": 1,
                  "routingPattern": 1,
                  "routingPatternGroup": null
              }
          },
          {
              "lcrId": 1,
              "priority": 1,
              "weight": 1,
              "id": 2,
              "rule": {
                  "lcrId": 1,
                  "prefix": "+93",
                  "fromUri": "^b1c1$",
                  "requestUri": null,
                  "stopper": 0,
                  "enabled": 1,
                  "tag": "Afghanistan",
                  "description": "",
                  "id": 2,
                  "routingPattern": 1,
                  "outgoingRouting": 1
              },
              "gw": {
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
                  "peerServer": 1
              },
              "outgoingRouting": {
                  "type": "pattern",
                  "priority": 1,
                  "weight": 1,
                  "id": 1,
                  "brand": 1,
                  "company": 1,
                  "peeringContract": 1,
                  "routingPattern": 1,
                  "routingPatternGroup": null
              }
          }
      ]
    """

  Scenario: Retrieve certain lcr rule targets json
    Given I add Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "lcr_rule_targets/1"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      {
          "lcrId": 1,
          "priority": 11,
          "weight": 6,
          "id": 1,
          "rule": {
              "lcrId": 1,
              "prefix": "+93",
              "fromUri": "^b1c[0-9]+$",
              "requestUri": null,
              "stopper": 0,
              "enabled": 1,
              "tag": "Afghanistan",
              "description": "",
              "id": 1,
              "routingPattern": 1,
              "outgoingRouting": 2
          },
          "gw": {
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
              "peerServer": 1
          },
          "outgoingRouting": {
              "type": "pattern",
              "priority": 11,
              "weight": 6,
              "id": 2,
              "brand": 1,
              "company": null,
              "peeringContract": 1,
              "routingPattern": 1,
              "routingPatternGroup": null
          }
      }
    """

Feature: Retrieve carrier servers
  In order to manage carrier servers
  As a brand admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the carrier servers json list
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "carrier_servers"
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
              "outboundProxy": null,
              "id": 1,
              "status": {
                  "registered": false
              }
          },
          {
              "ip": null,
              "hostname": "127.0.0.2",
              "authNeeded": "no",
              "sipProxy": "127.0.0.2",
              "outboundProxy": null,
              "id": 2,
              "status": {
                  "registered": false
              }

          }
      ]
      """

  Scenario: Retrieve certain carrier server json
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "carrier_servers/1"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
      """
      {
          "ip": null,
          "hostname": "127.0.0.1",
          "port": 5060,
          "uriScheme": 1,
          "transport": 1,
          "sendPAI": false,
          "sendRPID": false,
          "authNeeded": "no",
          "authUser": null,
          "authPassword": "*****",
          "sipProxy": "127.0.0.1",
          "outboundProxy": null,
          "fromUser": "",
          "fromDomain": "",
          "id": 1,
          "carrier": {
              "description": "CarrierDescription",
              "name": "CarrierName",
              "id": 1,
              "transformationRuleSet": 1
          }
      }
      """

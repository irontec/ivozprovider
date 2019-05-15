Feature: Create carrier servers
  In order to manage carrier servers
  As an super admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create a carrier servers
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/carrier_servers" with body:
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
          "carrier": 1
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
          "carrier": 1,
          "brand": 1
      }
    """

  Scenario: Retrieve created carrier server
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "carrier_servers/2"
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
          "carrier": {
              "description": "CarrierDescription",
              "name": "CarrierName",
              "externallyRated": false,
              "id": 1,
              "brand": 1,
              "transformationRuleSet": 1
          },
          "brand": "~"
      }
    """

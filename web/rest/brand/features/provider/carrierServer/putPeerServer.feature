Feature: Update carrier servers
  In order to manage carrier servers
  As an super admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update a carrier server
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/carrier_servers/1" with body:
    """
      {
          "ip": "127.1.0.1",
          "hostname": "hostname.net",
          "port": 5060,
          "uriScheme": 2,
          "transport": 2,
          "sendPAI": false,
          "sendRPID": false,
          "authNeeded": "no",
          "authUser": null,
          "authPassword": null,
          "sipProxy": "127.0.0.1",
          "outboundProxy": null,
          "fromUser": "",
          "fromDomain": "",
          "carrier": 1,
          "brand": 1
      }
    """
    Then the response status code should be 200
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be like:
    """
        {
            "ip": null,
            "hostname": "127.0.0.1",
            "port": 5060,
            "uriScheme": 2,
            "transport": 2,
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
            "carrier": {
                "description": "CarrierDescription",
                "name": "CarrierName",
                "externallyRated": false,
                "balance": 0,
                "calculateCost": false,
                "id": 1,
                "brand": 1,
                "transformationRuleSet": 1
            },
            "brand": "~"
        }
    """

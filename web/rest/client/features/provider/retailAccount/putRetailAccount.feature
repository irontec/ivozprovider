Feature: Update retail accounts
  In order to manage retail accounts
  As a client admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update a retail account
    Given I add Retail Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/retail_accounts/1" with body:
      """
      {
          "name": "readOnlyRetailAccount",
          "description": "updated desc",
          "transformationRuleSet": 1,
          "outgoingDdi": 3
      }
      """
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
      """
      {
          "name": "testRetailAccount",
          "description": "updated desc",
          "transport": "udp",
          "ip": null,
          "port": null,
          "password": "9rv6G3TVc-",
          "fromDomain": null,
          "directConnectivity": "no",
          "ddiIn": "yes",
          "t38Passthrough": "no",
          "rtpEncryption": false,
          "multiContact": true,
          "ruriDomain": null,
          "trustSDP": false,
          "id": 1,
          "transformationRuleSet": 1,
          "outgoingDdi": 3,
          "status": [
              {
                  "contact": "sip:yealinktest@10.10.1.109:5060",
                  "publicContact": false,
                  "received": "sip:212.64.172.26:5060",
                  "publicReceived": true,
                  "expires": "2031-01-01 00:59:59",
                  "userAgent": "Yealink SIP-T23G 44.80.0.130"
              }
          ]
      }
      """

  @createSchema
  Scenario: Update a retail account with ip+port
    Given I add Retail Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/retail_accounts/6" with body:
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
          "name": "testRetailAccount6",
          "description": "",
          "transport": "udp",
          "ip": "10.10.10.10",
          "port": 1010,
          "password": "9rv6G3TVc-",
          "fromDomain": null,
          "directConnectivity": "yes",
          "ddiIn": "yes",
          "t38Passthrough": "no",
          "rtpEncryption": false,
          "multiContact": true,
          "ruriDomain": null,
          "trustSDP": false,
          "id": 6,
          "transformationRuleSet": null,
          "outgoingDdi": null,
          "status": []
      }
      """

  @createSchema
  Scenario: Update a retail account with ruriDomain
    Given I add Retail Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/retail_accounts/6" with body:
      """
      {
        "directConnectivity": "yes",
        "ip": null,
        "port": null,
        "ruriDomain": "test.example.com"
      }
      """
     Then the response status code should be 200
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
      """
      {
          "name": "testRetailAccount6",
          "description": "",
          "transport": "udp",
          "ip": null,
          "port": null,
          "password": "9rv6G3TVc-",
          "fromDomain": null,
          "directConnectivity": "yes",
          "ddiIn": "yes",
          "t38Passthrough": "no",
          "rtpEncryption": false,
          "multiContact": true,
          "ruriDomain": "test.example.com",
          "trustSDP": false,
          "id": 6,
          "transformationRuleSet": null,
          "outgoingDdi": null,
          "status": []
      }
      """

  @createSchema
  Scenario: Update a retail account with invalid values
    Given I add Retail Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/retail_accounts/6" with body:
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
  Scenario: Update a retail account with ruriDomain and port without IP
    Given I add Retail Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/retail_accounts/6" with body:
      """
      {
        "directConnectivity": "yes",
        "ip": null,
        "port": "5070",
        "ruriDomain": "proxy.example.com"
      }
      """
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
      """
      {
          "name": "testRetailAccount6",
          "description": "",
          "transport": "udp",
          "ip": null,
          "port": 5070,
          "password": "9rv6G3TVc-",
          "fromDomain": null,
          "directConnectivity": "yes",
          "ddiIn": "yes",
          "t38Passthrough": "no",
          "rtpEncryption": false,
          "multiContact": true,
          "ruriDomain": "proxy.example.com",
          "trustSDP": false,
          "id": 6,
          "transformationRuleSet": null,
          "outgoingDdi": null,
          "status": []
      }
      """

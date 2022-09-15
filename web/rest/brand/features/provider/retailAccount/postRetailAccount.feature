Feature: Create retail accounts
  In order to manage retail accounts
  As a brand admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create a retail account
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/retail_accounts" with body:
    """
      {
          "name": "postRetailAccount",
          "description": "",
          "transport": "udp",
          "ip": "1.2.3.4",
          "port": 1024,
          "password": "3N-8g6zuXP",
          "fromDomain": null,
          "directConnectivity": "yes",
          "ddiIn": "yes",
          "t38Passthrough": "no",
          "company": 1,
          "transformationRuleSet": null,
          "outgoingDdi": null
      }
    """
    Then the response status code should be 201
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be equal to:
    """
      {
          "name": "postRetailAccount",
          "description": "",
          "transport": "udp",
          "ip": "1.2.3.4",
          "port": 1024,
          "password": "3N-8g6zuXP",
          "fromDomain": null,
          "directConnectivity": "yes",
          "ddiIn": "yes",
          "t38Passthrough": "no",
          "rtpEncryption": false,
          "multiContact": true,
          "id": 2,
          "company": 1,
          "transformationRuleSet": null,
          "outgoingDdi": null
      }
    """

  Scenario: Retrieve created retail account
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "retail_accounts/2"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
    """
      {
          "name": "postRetailAccount",
          "description": "",
          "transport": "udp",
          "ip": "1.2.3.4",
          "port": 1024,
          "password": "3N-8g6zuXP",
          "fromDomain": null,
          "directConnectivity": "yes",
          "ddiIn": "yes",
          "t38Passthrough": "no",
          "id": 2,
          "company": "~",
          "transformationRuleSet": null,
          "outgoingDdi": null
      }
    """

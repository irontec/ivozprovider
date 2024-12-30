Feature: Update ddi
  In order to manage call forward settings
  As a brand admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update a retail account
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/retail_accounts/1" with body:
      """
      {
          "name": "updatedRetailAccount",
          "description": "demo description",
          "transport": "udp",
          "ip": null,
          "port": null,
          "password": "8rv6G3TVc-",
          "fromDomain": null,
          "directConnectivity": "no",
          "ddiIn": "yes",
          "t38Passthrough": "no",
          "transformationRuleSet": null,
          "outgoingDdi": null,
          "proxyUser": 1
      }
      """
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      {
          "name": "updatedRetailAccount",
          "description": "demo description",
          "transport": "udp",
          "ip": null,
          "port": null,
          "password": "8rv6G3TVc-",
          "fromDomain": null,
          "directConnectivity": "no",
          "ddiIn": "yes",
          "t38Passthrough": "no",
          "rtpEncryption": false,
          "multiContact": true,
          "ruriDomain": null,
          "id": 1,
          "company": 3,
          "transformationRuleSet": null,
          "outgoingDdi": null,
          "proxyUser": null,
          "status": []
      }
      """

  @createSchema
  Scenario: Update a retail account company must fail
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/retail_accounts/1" with body:
      """
      {
        "company": 1
      }
      """
     Then the response status code should be 400

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
          "password": "9rv6G3TVc-",
          "id": 1,
          "transformationRuleSet": 1,
          "outgoingDdi": 3
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
        "id": 6,
        "directConnectivity": "yes",
        "ip": "10.10.10.10",
        "port": 1010,
        "ruriDomain": null
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
        "id": 6,
        "directConnectivity": "yes",
        "ip": null,
        "port": null,
        "ruriDomain": "test.example.com"
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

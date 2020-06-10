Feature: Retrieve retail accounts
  In order to manage retail accounts
  As a brand admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the retail accounts json list
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "retail_accounts"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
      [
          {
              "name": "testRetailAccount",
              "transport": "udp",
              "id": 1
          }
      ]
    """

  Scenario: Retrieve certain retail account json
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "retail_accounts/1"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
    """
      {
          "name": "testRetailAccount",
          "description": "",
          "transport": "udp",
          "ip": null,
          "port": null,
          "password": "9rv6G3TVc-",
          "fromDomain": null,
          "directConnectivity": "no",
          "ddiIn": "yes",
          "t38Passthrough": "no",
          "id": 1,
          "company": "~",
          "transformationRuleSet": null,
          "outgoingDdi": null
      }
    """

Feature: Retrieve retail accounts
  In order to manage retail accounts
  As an super admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the retail accounts json list
    Given I add Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "retail_accounts"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      [
          {
              "name": "retail",
              "transport": "udp",
              "authNeeded": "yes",
              "id": 1
          }
      ]
    """

  Scenario: Retrieve certain retail account json
    Given I add Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "retail_accounts/1"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be like:
    """
      {
          "name": "retail",
          "description": "",
          "transport": "udp",
          "ip": null,
          "port": null,
          "authNeeded": "yes",
          "password": "****",
          "disallow": "all",
          "allow": "alaw",
          "directMediaMethod": "invite",
          "calleridUpdateHeader": "pai",
          "updateCallerid": "yes",
          "fromDomain": null,
          "directConnectivity": "yes",
          "id": 1,
          "brand": "~",
          "company": "~",
          "transformationRuleSet": null,
          "outgoingDdi": null,
          "language": null
      }
    """

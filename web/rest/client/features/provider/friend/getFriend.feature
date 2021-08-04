Feature: Retrieve friends
  In order to manage friends
  As a client admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the friends json list
    Given I add Company Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "friends"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      [
          {
              "name": "testFriend",
              "description": "",
              "priority": 1,
              "id": 1,
              "domain": 3
          }
      ]
    """

  Scenario: Retrieve certain friend json
    Given I add Company Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "friends/1"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be like:
    """
      {
          "name": "testFriend",
          "description": "",
          "transport": "udp",
          "ip": "1.2.3.4",
          "port": 5060,
          "password": "SDG3qd2j6+",
          "priority": 1,
          "allow": "alaw",
          "fromDomain": "",
          "directConnectivity": "yes",
          "ddiIn": "yes",
          "t38Passthrough": "no",
          "id": 1,
          "transformationRuleSet": null,
          "callAcl": null,
          "outgoingDdi": null,
          "language": null
      }
    """

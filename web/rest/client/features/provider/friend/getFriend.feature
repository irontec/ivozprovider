Feature: Retrieve friends
  In order to manage friends
  As an super admin
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
              "id": 1
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
          "ip": "",
          "port": 5060,
          "authNeeded": "yes",
          "password": "****",
          "priority": 1,
          "disallow": "all",
          "allow": "alaw",
          "directMediaMethod": "update",
          "calleridUpdateHeader": "pai",
          "updateCallerid": "yes",
          "fromDomain": "",
          "directConnectivity": "yes",
          "id": 1,
          "company": "~",
          "callAcl": null,
          "outgoingDdi": null,
          "language": null
      }
    """

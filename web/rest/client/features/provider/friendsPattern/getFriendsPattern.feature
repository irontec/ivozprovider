Feature: Retrieve friends patterns
  In order to manage friends patterns
  As an super admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the friends patterns json list
    Given I add Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "friends_patterns"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      [
          {
              "name": "Spain",
              "regExp": "+34",
              "id": 1
          }
      ]
    """

  Scenario: Retrieve certain friends patterns json
    Given I add Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "friends_patterns/1"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      {
          "name": "Spain",
          "regExp": "+34",
          "id": 1,
          "friend": {
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
              "company": 1,
              "domain": 3,
              "transformationRuleSet": null,
              "callAcl": null,
              "outgoingDdi": null,
              "language": null
          }
      }
    """

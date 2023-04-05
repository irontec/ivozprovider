Feature: Retrieve friends patterns
  In order to manage friends patterns
  As a client admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the friends patterns json list
    Given I add Company Authorization header
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
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "friends_patterns/1"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
      """
      {
          "name": "Spain",
          "regExp": "+34",
          "id": 1,
          "friend": {
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
      }
      """

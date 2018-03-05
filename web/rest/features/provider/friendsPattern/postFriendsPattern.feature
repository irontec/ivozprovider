Feature: Create friends patterns
  In order to manage friends patterns
  As an super admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create a friend pattern
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/friends_patterns" with body:
    """
      {
          "name": "Baske Country",
          "regExp": "+3494",
          "friend": 1
      }
    """
    Then the response status code should be 201
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be equal to:
    """
      {
          "name": "Baske Country",
          "regExp": "+3494",
          "id": 2
      }
    """

  Scenario: Retrieve created friend pattern
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "friends_patterns/2"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
      {
          "name": "Baske Country",
          "regExp": "+3494",
          "id": 2,
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

Feature: Create pick up rel users
  In order to manage pick up rel users
  As a client admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create a pick up rel user
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/pick_up_rel_users" with body:
    """
      {
          "pickUpGroup": 1,
          "user": 2
      }
    """
    Then the response status code should be 201
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be equal to:
    """
      {
          "id": 2,
          "pickUpGroup": {
              "name": "pick up group",
              "id": 1
          },
          "user": {
              "name": "Bob",
              "lastname": "Bobson",
              "email": "bob@democompany.com",
              "pass": "*****",
              "doNotDisturb": false,
              "isBoss": true,
              "active": true,
              "maxCalls": 1,
              "externalIpCalls": "0",
              "rejectCallMethod": "rfc",
              "multiContact": true,
              "gsQRCode": false,
              "id": 2,
              "callAcl": null,
              "bossAssistant": 1,
              "bossAssistantWhiteList": null,
              "transformationRuleSet": 1,
              "language": null,
              "terminal": 2,
              "extension": null,
              "timezone": 145,
              "outgoingDdi": null,
              "outgoingDdiRule": null,
              "voicemail": null
          }
      }
    """

  Scenario: Retrieve created pick up rel user
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "/pick_up_rel_users/2"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
      {
            "id": 2,
            "pickUpGroup": {
                "name": "pick up group",
                "id": 1
            },
            "user": {
                "name": "Bob",
                "lastname": "Bobson",
                "email": "bob@democompany.com",
                "pass": "*****",
                "doNotDisturb": false,
                "isBoss": true,
                "active": true,
                "maxCalls": 1,
                "externalIpCalls": "0",
                "rejectCallMethod": "rfc",
                "multiContact": true,
                "gsQRCode": false,
                "id": 2,
                "callAcl": null,
                "bossAssistant": 1,
                "bossAssistantWhiteList": null,
                "transformationRuleSet": 1,
                "language": null,
                "terminal": 2,
                "extension": null,
                "timezone": 145,
                "outgoingDdi": null,
                "outgoingDdiRule": null,
                "voicemail": null
            }
      }
    """

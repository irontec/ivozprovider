Feature: Retrieve pick up rel users
  In order to manage pick up rel users
  As an super admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the pick up rel users json list
    Given I add Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "pick_up_rel_users"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      [
          {
              "id": 1,
              "pickUpGroup": {
                  "name": "pick up group",
                  "id": 1,
                  "company": 1
              },
              "user": {
                  "name": "Alice",
                  "lastname": "Allison",
                  "email": "alice@democompany.com",
                  "pass": "*****",
                  "doNotDisturb": false,
                  "isBoss": false,
                  "active": true,
                  "maxCalls": 1,
                  "externalIpCalls": "0",
                  "voicemailEnabled": true,
                  "voicemailSendMail": true,
                  "voicemailAttachSound": true,
                  "tokenKey": "ec6a6536ca304edf844d1d248a4f08dc",
                  "gsQRCode": false,
                  "id": 1,
                  "company": 1,
                  "callAcl": null,
                  "bossAssistant": null,
                  "bossAssistantWhiteList": null,
                  "transformationRuleSet": 1,
                  "language": null,
                  "terminal": 1,
                  "extension": null,
                  "timezone": 1,
                  "outgoingDdi": null,
                  "outgoingDdiRule": null,
                  "voicemailLocution": null
              }
          }
      ]
    """

  Scenario: Retrieve certain pick up rel user json
    Given I add Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "pick_up_rel_users/1"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      {
          "id": 1,
          "pickUpGroup": {
              "name": "pick up group",
              "id": 1,
              "company": 1
          },
          "user": {
              "name": "Alice",
              "lastname": "Allison",
              "email": "alice@democompany.com",
              "pass": "*****",
              "doNotDisturb": false,
              "isBoss": false,
              "active": true,
              "maxCalls": 1,
              "externalIpCalls": "0",
              "voicemailEnabled": true,
              "voicemailSendMail": true,
              "voicemailAttachSound": true,
              "tokenKey": "ec6a6536ca304edf844d1d248a4f08dc",
              "gsQRCode": false,
              "id": 1,
              "company": 1,
              "callAcl": null,
              "bossAssistant": null,
              "bossAssistantWhiteList": null,
              "transformationRuleSet": 1,
              "language": null,
              "terminal": 1,
              "extension": null,
              "timezone": 1,
              "outgoingDdi": null,
              "outgoingDdiRule": null,
              "voicemailLocution": null
          }
      }
    """

Feature: Create pick up rel users
  In order to manage pick up rel users
  As an super admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create a pick up rel user
    Given I add Authorization header
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
              "id": 1,
              "company": 1
          },
          "user": {
              "name": "Bob",
              "lastname": "Bobson",
              "email": "bob@democompany.com",
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
              "id": 2,
              "company": 1,
              "callAcl": null,
              "bossAssistant": null,
              "bossAssistantWhiteList": null,
              "transformationRuleSet": 1,
              "language": null,
              "terminal": 2,
              "extension": null,
              "timezone": 1,
              "outgoingDdi": null,
              "outgoingDdiRule": null,
              "voicemailLocution": null
          }
      }
    """

  Scenario: Retrieve created pick up rel user
    Given I add Authorization header
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
              "id": 1,
              "company": 1
          },
          "user": {
              "name": "Bob",
              "lastname": "Bobson",
              "email": "bob@democompany.com",
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
              "id": 2,
              "company": 1,
              "callAcl": null,
              "bossAssistant": null,
              "bossAssistantWhiteList": null,
              "transformationRuleSet": 1,
              "language": null,
              "terminal": 2,
              "extension": null,
              "timezone": 1,
              "outgoingDdi": null,
              "outgoingDdiRule": null,
              "voicemailLocution": null
          }
      }
    """

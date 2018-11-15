Feature: Update hunt groups
  In order to manage hunt groups
  As an super admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update a hunt group
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/hunt_groups/1" with body:
    """
      {
          "name": "updatedHuntGroup",
          "description": "desc",
          "strategy": "ringAll",
          "ringAllTimeout": 10,
          "noAnswerTargetType": "voicemail",
          "noAnswerNumberValue": null,
          "company": 2,
          "noAnswerLocution": null,
          "noAnswerExtension": null,
          "noAnswerVoiceMailUser": 1,
          "noAnswerNumberCountry": null
      }
    """
    Then the response status code should be 200
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be like:
    """
      {
          "name": "updatedHuntGroup",
          "description": "desc",
          "strategy": "ringAll",
          "ringAllTimeout": 10,
          "noAnswerTargetType": "voicemail",
          "noAnswerNumberValue": null,
          "preventMissedCalls": 1,
          "id": 1,
          "company": "~",
          "noAnswerLocution": null,
          "noAnswerExtension": null,
          "noAnswerVoiceMailUser": {
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
              "language": null,
              "terminal": 1,
              "extension": null,
              "timezone": 1,
              "outgoingDdi": null,
              "outgoingDdiRule": null,
              "voicemailLocution": null
          },
          "noAnswerNumberCountry": null
      }
    """

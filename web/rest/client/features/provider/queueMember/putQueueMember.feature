Feature: Update queue members
  In order to manage queue members
  As an super admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update a queue member
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/queue_members/1" with body:
    """
      {
          "penalty": 2,
          "queue": 1,
          "user": 2
      }
    """
    Then the response status code should be 200
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be equal to:
    """
      {
          "penalty": 2,
          "id": 1,
          "queue": {
              "name": "testQueue",
              "maxWaitTime": 20,
              "timeoutTargetType": "number",
              "timeoutNumberValue": "946002020",
              "maxlen": 5,
              "fullTargetType": "number",
              "fullNumberValue": "946002021",
              "periodicAnnounceFrequency": 7,
              "memberCallRest": 0,
              "memberCallTimeout": 1,
              "strategy": "rrmemory",
              "weight": 5,
              "id": 1,
              "company": 1,
              "periodicAnnounceLocution": 1,
              "timeoutLocution": 1,
              "timeoutExtension": null,
              "timeoutVoiceMailUser": null,
              "fullLocution": 1,
              "fullExtension": null,
              "fullVoiceMailUser": null,
              "timeoutNumberCountry": 1,
              "fullNumberCountry": 1
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
              "voicemailEnabled": true,
              "voicemailSendMail": true,
              "voicemailAttachSound": true,
              "tokenKey": "ec6a6536ca304edf844d1d248a4f08dc",
              "gsQRCode": false,
              "id": 2,
              "company": 1,
              "callAcl": null,
              "bossAssistant": 1,
              "bossAssistantWhiteList": null,
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

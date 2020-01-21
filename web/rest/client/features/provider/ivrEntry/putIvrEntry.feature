Feature: Update IVR entries
  In order to manage IVR entries
  As a client admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update a IVR entry
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/ivr_entries/1" with body:
    """
      {
          "entry": "test",
          "routeType": "voicemail",
          "numberValue": null,
          "ivr": 1,
          "welcomeLocution": 1,
          "extension": null,
          "voiceMailUser": 1,
          "conditionalRoute": null,
          "numberCountry": 2
      }
    """
    Then the response status code should be 200
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be equal to:
    """
     {
          "entry": "test",
          "routeType": "voicemail",
          "numberValue": null,
          "id": 1,
          "ivr": {
              "name": "testIvrCustom",
              "timeout": 6,
              "maxDigits": 0,
              "allowExtensions": false,
              "noInputRouteType": "number",
              "noInputNumberValue": "946002020",
              "errorRouteType": "voicemail",
              "errorNumberValue": null,
              "id": 1,
              "welcomeLocution": 1,
              "noInputLocution": null,
              "errorLocution": null,
              "successLocution": 1,
              "noInputExtension": null,
              "errorExtension": null,
              "noInputVoiceMailUser": null,
              "errorVoiceMailUser": 1,
              "noInputNumberCountry": 68,
              "errorNumberCountry": null
          },
          "welcomeLocution": {
              "name": "testLocution",
              "status": null,
              "id": 1,
              "encodedFile": {
                  "fileSize": 1,
                  "mimeType": "audio/x-wav; charset=binary",
                  "baseName": "locution.wav"
              },
              "originalFile": {
                  "fileSize": 1,
                  "mimeType": "audio\/mpeg; charset=binary",
                  "baseName": "locution.mp3"
              }
          },
          "extension": null,
          "voiceMailUser": {
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
              "gsQRCode": false,
              "id": 1,
              "callAcl": null,
              "bossAssistant": null,
              "bossAssistantWhiteList": null,
              "transformationRuleSet": 1,
              "language": null,
              "terminal": 1,
              "extension": null,
              "timezone": 145,
              "outgoingDdi": null,
              "outgoingDdiRule": null,
              "voicemailLocution": null
          },
          "conditionalRoute": null,
          "numberCountry": null
      }
    """

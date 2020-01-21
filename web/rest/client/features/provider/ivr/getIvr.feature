Feature: Retrieve IVRs
  In order to manage IVRs
  As a client admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the IVRs json list
    Given I add Company Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "ivrs"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      [
          {
              "name": "testIvrCustom",
              "id": 1
          },
          {
              "name": "testIvrCustom2",
              "id": 2
          }
      ]
    """

  Scenario: Retrieve certain IVR json
    Given I add Company Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "ivrs/1"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be like:
    """
      {
          "name": "testIvrCustom",
          "timeout": 6,
          "maxDigits": 0,
          "allowExtensions": false,
          "noInputRouteType": "number",
          "noInputNumberValue": "946002020",
          "errorRouteType": "voicemail",
          "errorNumberValue": null,
          "id": 1,
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
                  "mimeType": "audio/mpeg; charset=binary",
                  "baseName": "locution.mp3"
              }
          },
          "noInputLocution": null,
          "errorLocution": null,
          "successLocution": {
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
                  "mimeType": "audio/mpeg; charset=binary",
                  "baseName": "locution.mp3"
              }
          },
          "noInputExtension": null,
          "errorExtension": null,
          "noInputVoiceMailUser": null,
          "errorVoiceMailUser": {
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
          "noInputNumberCountry": {
              "code": "ES",
              "countryCode": "+34",
              "id": 68,
              "name": {
                  "en": "Spain",
                  "es": "España",
                  "ca": "España"
              },
              "zone": {
                  "en": "Europe",
                  "es": "Europa",
                  "ca": "Europa"
              }
          },
          "errorNumberCountry": null,
          "excludedExtensionIds": [
              1
          ]
      }
    """

Feature: Retrieve voicemails
  In order to manage voicemails
  As a client admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the voicemails json list
    Given I add Company Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "voicemails"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      [
          {
              "enabled": true,
              "name": "Voicemail For User1",
              "email": "alice@democompany.com",
              "id": 1,
              "user": 1
          },
          {
              "enabled": true,
              "name": "Voicemail For Residential 1",
              "email": "",
              "id": 2,
              "user": null
          },
          {
              "enabled": true,
              "name": "Voicemail Generic 1",
              "email": "generic@voicemail.com",
              "id": 3,
              "user": null
          },
          {
              "enabled": true,
              "name": "Voicemail For User2",
              "email": "bob@voicemail.com",
              "id": 4,
              "user": 2
          }
      ]
    """

  Scenario: Retrieve certain voicemail json
    Given I add Company Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "voicemails/1"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be like:
    """
      {
          "enabled": true,
          "name": "Voicemail For User1",
          "email": "alice@democompany.com",
          "sendMail": true,
          "attachSound": true,
          "id": 1,
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
              "rejectCallMethod": "rfc",
              "multiContact": true,
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
              "voicemail": null
          },
          "residentialDevice": null,
          "company": {
              "type": "vpbx",
              "name": "DemoCompany",
              "domainUsers": "127.0.0.1",
              "nif": "12345678A",
              "onDemandRecordCode": "",
              "balance": 1.2,
              "id": 1,
              "language": 1,
              "defaultTimezone": 145,
              "country": 68,
              "transformationRuleSet": 1,
              "outgoingDdi": null,
              "outgoingDdiRule": null
          },
          "locution": {
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
          }
      }
    """

Feature: Update call forward settings
  In order to manage call forward settings
  As an super admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update a call forward setting
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/call_forward_settings/1" with body:
    """
      {
        "callTypeFilter": "internal",
        "callForwardType": "inconditional",
        "targetType": "number",
        "numberValue": "946002021",
        "noAnswerTimeout": 0,
        "enabled": true,
        "user": 1,
        "extension": null,
        "voiceMailUser": null,
        "numberCountry": 1
      }
    """
    Then the response status code should be 200
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be equal to:
    """
      {
          "callTypeFilter": "internal",
          "callForwardType": "inconditional",
          "targetType": "number",
          "numberValue": "946002021",
          "noAnswerTimeout": 0,
          "enabled": true,
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
              "voicemailEnabled": true,
              "voicemailSendMail": true,
              "voicemailAttachSound": true,
              "tokenKey": "4c18027290f0c1ed517680bb4bcf2402",
              "gsQRCode": false,
              "id": 1,
              "company": 1,
              "callAcl": null,
              "bossAssistant": null,
              "bossAssistantWhiteList": null,
              "language": null,
              "terminal": 1,
              "extension": null,
              "timezone": 145,
              "outgoingDdi": null,
              "outgoingDdiRule": null,
              "voicemailLocution": null
          },
          "extension": null,
          "voiceMailUser": null,
          "numberCountry": {
              "code": "AD",
              "countryCode": "+376",
              "id": 1,
              "name": {
                  "en": "Andorra",
                  "es": "Andorra"
              },
              "zone": {
                  "en": "Europe",
                  "es": "Andorra"
              }
          },
          "residentialDevice": null,
          "retailAccount": null
      }
    """

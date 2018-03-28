Feature: Retrieve callForwardSetting
  In order to manage call forward setting
  As an super admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve call forward settings json list
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "call_forward_settings"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
      [
          {
              "callTypeFilter": "internal",
              "callForwardType": "inconditional",
              "targetType": "number",
              "id": 1
          },
          {
              "callTypeFilter": "external",
              "callForwardType": "noAnswer",
              "targetType": "number",
              "id": 2
          },
          {
              "callTypeFilter": "external",
              "callForwardType": "busy",
              "targetType": "number",
              "id": 3
          },
          {
              "callTypeFilter": "external",
              "callForwardType": "userNotRegistered",
              "targetType": "number",
              "id": 4
          }
      ]
    """

  Scenario: Retrieve certain call forward setting json
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "call_forward_settings/1"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
      {
          "callTypeFilter": "internal",
          "callForwardType": "inconditional",
          "targetType": "number",
          "numberValue": "946002053",
          "noAnswerTimeout": 10,
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
          },
          "extension": null,
          "voiceMailUser": null,
          "numberCountry": {
              "code": "ES",
              "countryCode": "+34",
              "id": 1,
              "name": {
                  "en": "Spain",
                  "es": "España"
              },
              "zone": {
                  "en": "Europe",
                  "es": "Europa"
              }
          }
      }
    """

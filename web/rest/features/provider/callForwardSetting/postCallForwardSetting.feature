Feature: Create application servers
  In order to manage call forward settings
  As an super admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create an call forward setting
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/call_forward_settings" with body:
    """
      {
        "callTypeFilter": "internal",
        "callForwardType": "inconditional",
        "targetType": "number",
        "numberValue": "946002020",
        "noAnswerTimeout": 0,
        "user": 2,
        "extension": null,
        "voiceMailUser": null,
        "numberCountry": 1,
        "enabled": true
      }
    """
    Then the response status code should be 201
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be equal to:
    """
      {
          "callTypeFilter": "internal",
          "callForwardType": "inconditional",
          "targetType": "number",
          "enabled": true,
          "id": 5
      }
    """

  Scenario: Retrieve created call forward setting
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "call_forward_settings/5"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
      {
          "callTypeFilter": "internal",
          "callForwardType": "inconditional",
          "targetType": "number",
          "numberValue": "946002020",
          "noAnswerTimeout": 0,
          "enabled": true,
          "id": 5,
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

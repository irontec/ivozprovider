Feature: Retrieve call forward settings
  In order to manage call forward settings
  As a user
  I need to be able to retrieve them through the API.

  @createSchema @userApiContext
  Scenario: Retrieve the call forward settings json list
    Given I add User Authorization header
     When I add "Accept" header equal to "application/json"
    And I send a "POST" request to "my/call_forward_settings" with body:
    """
      {
              "callTypeFilter": "external",
              "callForwardType": "inconditional",
              "targetType": "number",
              "numberValue": "946002054",
              "noAnswerTimeout": 5,
              "enabled": false,
              "user": 1,
              "extension": null,
              "voiceMailUser": null,
              "numberCountry": 68
          }
    """
    Then the response status code should be 201
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      {
          "callTypeFilter": "external",
          "callForwardType": "inconditional",
          "targetType": "number",
          "numberValue": "946002054",
          "noAnswerTimeout": 5,
          "enabled": false,
          "id": 5,
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
              "tokenKey": "",
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
              "timezone": 145,
              "outgoingDdi": null,
              "outgoingDdiRule": null,
              "voicemailLocution": null
          },
          "extension": null,
          "voiceMailUser": null,
          "numberCountry": {
              "code": "ES",
              "countryCode": "+34",
              "id": 68,
              "name": {
                  "en": "Spain",
                  "es": "España"
              },
              "zone": {
                  "en": "Europe",
                  "es": "Europa"
              }
          },
          "residentialDevice": null,
          "retailAccount": null
      }
    """

  @userApiContext
  Scenario: Retrieve created call forward settings
    Given I add Company Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "call_forward_settings/5"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      {
            "callTypeFilter": "external",
            "callForwardType": "inconditional",
            "targetType": "number",
            "numberValue": "946002054",
            "noAnswerTimeout": 5,
            "enabled": false,
            "id": 5,
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
                "tokenKey": "",
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
                "timezone": 145,
                "outgoingDdi": null,
                "outgoingDdiRule": null,
                "voicemailLocution": null
            },
            "extension": null,
            "voiceMailUser": null,
            "numberCountry": {
                "code": "ES",
                "countryCode": "+34",
                "id": 68,
                "name": {
                    "en": "Spain",
                    "es": "España"
                },
                "zone": {
                    "en": "Europe",
                    "es": "Europa"
                }
            },
            "residentialDevice": null,
            "retailAccount": null
        }
    """

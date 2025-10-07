Feature: Retrieve call forward settings
  In order to manage call forward settings
  As a user
  I need to be able to retrieve them through the API.

  @createSchema @userApiContext
  Scenario: Retrieve the call forward settings json list
    Given I add User Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "my/call_forward_settings"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
      """
      [
          {
              "callTypeFilter": "external",
              "callForwardType": "busy",
              "targetType": "number",
              "numberValue": "946002053",
              "noAnswerTimeout": 0,
              "enabled": true,
              "id": 3,
              "user": "~",
              "extension": null,
              "voicemail": null,
              "numberCountry": "~"
          },
          {
              "callTypeFilter": "external",
              "callForwardType": "noAnswer",
              "targetType": "number",
              "numberValue": "946002053",
              "noAnswerTimeout": 10,
              "enabled": true,
              "id": 2,
              "user": "~",
              "extension": null,
              "voicemail": null,
              "numberCountry": "~"
          },
          {
              "callTypeFilter": "external",
              "callForwardType": "userNotRegistered",
              "targetType": "number",
              "numberValue": "946002054",
              "noAnswerTimeout": 0,
              "enabled": true,
              "id": 4,
              "user": "~",
              "extension": null,
              "voicemail": null,
              "numberCountry": "~"
          },
          {
              "callTypeFilter": "internal",
              "callForwardType": "inconditional",
              "targetType": "number",
              "numberValue": "946002053",
              "noAnswerTimeout": 0,
              "enabled": true,
              "id": 1,
              "user": "~",
              "extension": null,
              "voicemail": null,
              "numberCountry": "~"
          }
      ]
      """

  Scenario: Retrieve call forward settings item
    Given I add User Authorization header
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
            "rejectCallMethod": "rfc",
            "multiContact": true,
            "gsQRCode": false,
            "useDefaultLocation": true,
            "id": 1,
            "bossAssistant": null,
            "extension": null,
            "timezone": 145,
            "voicemail": null
        },
        "extension": null,
        "voicemail": null,
        "numberCountry": {
            "code": "ES",
            "countryCode": "+34",
            "id": 68,
            "name": {
                "en": "Spain",
                "es": "España",
                "ca": "España",
                "it": "Spagna"
            },
            "zone": {
                "en": "Europe",
                "es": "Europa",
                "ca": "Europa",
                "it": "Europe"
            }
        }
      }
      """

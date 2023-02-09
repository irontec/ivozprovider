Feature: Retrieve callForwardSetting
  In order to manage call forward setting
  As a client admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve call forward settings json list
    Given I add Company Authorization header
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
              "numberValue": "946002053",
              "enabled": true,
              "id": 1,
              "user": 1,
              "extension": null,
              "voicemail": null,
              "numberCountry": 68,
              "residentialDevice": null,
              "retailAccount": null,
              "cfwToRetailAccount": null,
              "ddi": null
          },
          {
              "callTypeFilter": "external",
              "callForwardType": "noAnswer",
              "targetType": "number",
              "numberValue": "946002053",
              "enabled": true,
              "id": 2,
              "user": 1,
              "extension": null,
              "voicemail": null,
              "numberCountry": 68,
              "residentialDevice": null,
              "retailAccount": null,
              "cfwToRetailAccount": null,
              "ddi": null
          },
          {
              "callTypeFilter": "external",
              "callForwardType": "busy",
              "targetType": "number",
              "numberValue": "946002053",
              "enabled": true,
              "id": 3,
              "user": 1,
              "extension": null,
              "voicemail": null,
              "numberCountry": 68,
              "residentialDevice": null,
              "retailAccount": null,
              "cfwToRetailAccount": null,
              "ddi": null
          },
          {
              "callTypeFilter": "external",
              "callForwardType": "userNotRegistered",
              "targetType": "number",
              "numberValue": "946002054",
              "enabled": true,
              "id": 4,
              "user": 1,
              "extension": null,
              "voicemail": null,
              "numberCountry": 68,
              "residentialDevice": null,
              "retailAccount": null,
              "cfwToRetailAccount": null,
              "ddi": null
          }
      ]
    """

  Scenario: Retrieve certain call forward setting json
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "call_forward_settings/1"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
    """
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
          "numberCountry": {
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
          }
      }
    """

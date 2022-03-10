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
              "timeout": 6,
              "allowExtensions": false,
              "noInputRouteType": "number",
              "noInputNumberValue": "946002020",
              "errorRouteType": "voicemail",
              "errorNumberValue": null,
              "id": 1,
              "noInputLocution": null,
              "errorLocution": null,
              "successLocution": 1,
              "noInputExtension": null,
              "errorExtension": null,
              "noInputVoicemail": null,
              "errorVoicemail": 1,
              "noInputNumberCountry": 68,
              "errorNumberCountry": null
          },
          {
              "name": "testIvrCustom2",
              "timeout": 6,
              "allowExtensions": false,
              "noInputRouteType": "extension",
              "noInputNumberValue": null,
              "errorRouteType": "voicemail",
              "errorNumberValue": null,
              "id": 2,
              "noInputLocution": null,
              "errorLocution": null,
              "successLocution": 1,
              "noInputExtension": 1,
              "errorExtension": null,
              "noInputVoicemail": null,
              "errorVoicemail": 1,
              "noInputNumberCountry": null,
              "errorNumberCountry": null
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
          "noInputVoicemail": null,
          "errorVoicemail": {
              "enabled": true,
              "name": "Voicemail For User1",
              "email": "alice@democompany.com",
              "sendMail": true,
              "attachSound": true,
              "id": 1,
              "user": 1,
              "residentialDevice": null,
              "company": 1,
              "locution": 1
          },
          "noInputNumberCountry": {
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
          },
          "errorNumberCountry": null,
          "excludedExtensionIds": [
              1
          ]
      }
    """

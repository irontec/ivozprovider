Feature: Retrieve ivr entries
  In order to manage ivr entries
  As a client admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the ivr entries json list
    Given I add Company Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "ivr_entries"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      [
          {
              "entry": "test",
              "routeType": "number",
              "numberValue": "946002050",
              "id": 1,
              "ivr": 1,
              "welcomeLocution": 1,
              "extension": null,
              "voicemail": null,
              "conditionalRoute": null,
              "numberCountry": 68
          }
      ]
    """

  Scenario: Retrieve certain ivr entry json
    Given I add Company Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "ivr_entries/1"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be like:
    """
      {
          "entry": "test",
          "routeType": "number",
          "numberValue": "946002050",
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
              "noInputVoicemail": null,
              "errorVoicemail": 1,
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
          "voicemail": null,
          "conditionalRoute": null,
          "numberCountry": "~"
      }
    """

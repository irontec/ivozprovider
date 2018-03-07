Feature: Retrieve ivr entries
  In order to manage ivr entries
  As an super admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the ivr entries json list
    Given I add Authorization header
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
              "id": 1
          }
      ]
    """

  Scenario: Retrieve certain ivr entry json
    Given I add Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "ivr_entries/1"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
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
              "errorRouteType": "number",
              "errorNumberValue": "946002021",
              "id": 1,
              "company": 1,
              "welcomeLocution": 1,
              "noInputLocution": null,
              "errorLocution": null,
              "successLocution": 1,
              "noInputExtension": null,
              "errorExtension": null,
              "noInputVoiceMailUser": null,
              "errorVoiceMailUser": null,
              "noInputNumberCountry": 1,
              "errorNumberCountry": 1
          },
          "welcomeLocution": {
              "name": "testLocution",
              "status": null,
              "id": 1,
              "encodedFile": {
                  "fileSize": null,
                  "mimeType": null,
                  "baseName": null
              },
              "originalFile": {
                  "fileSize": null,
                  "mimeType": null,
                  "baseName": null
              },
              "company": 1
          },
          "extension": null,
          "voiceMailUser": null,
          "conditionalRoute": null,
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

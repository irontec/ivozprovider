Feature: Retrieve ivr excluded extensions
  In order to manage ivr excluded extensions
  As an super admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the ivr excluded extensions json list
    Given I add Company Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "ivr_excluded_extensions"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
       [
          {
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
                  "company": 1,
                  "welcomeLocution": 1,
                  "noInputLocution": null,
                  "errorLocution": null,
                  "successLocution": 1,
                  "noInputExtension": null,
                  "errorExtension": null,
                  "noInputVoiceMailUser": null,
                  "errorVoiceMailUser": 1,
                  "noInputNumberCountry": 1,
                  "errorNumberCountry": null
              },
              "extension": {
                  "number": "101",
                  "routeType": "user",
                  "numberValue": null,
                  "friendValue": null,
                  "id": 1,
                  "company": 1,
                  "ivr": null,
                  "huntGroup": null,
                  "conferenceRoom": null,
                  "user": 1,
                  "queue": null,
                  "conditionalRoute": null,
                  "numberCountry": null
              }
          }
      ]
    """

  Scenario: Retrieve certain ivr excluded extension json
    Given I add Company Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "ivr_excluded_extensions/1"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      {
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
              "company": 1,
              "welcomeLocution": 1,
              "noInputLocution": null,
              "errorLocution": null,
              "successLocution": 1,
              "noInputExtension": null,
              "errorExtension": null,
              "noInputVoiceMailUser": null,
              "errorVoiceMailUser": 1,
              "noInputNumberCountry": 1,
              "errorNumberCountry": null
          },
          "extension": {
              "number": "101",
              "routeType": "user",
              "numberValue": null,
              "friendValue": null,
              "id": 1,
              "company": 1,
              "ivr": null,
              "huntGroup": null,
              "conferenceRoom": null,
              "user": 1,
              "queue": null,
              "conditionalRoute": null,
              "numberCountry": null
          }
      }
    """

Feature: Create IVR excluded extensions
  In order to manage IVR excluded extensions
  As an super admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create a IVR excluded extension
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/ivr_excluded_extensions" with body:
    """
      {
          "id": 1,
          "ivr": 1,
          "extension": 2
      }
    """
    Then the response status code should be 201
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be equal to:
    """
      {
          "id": 2,
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
              "number": "102",
              "routeType": "user",
              "numberValue": null,
              "friendValue": null,
              "id": 2,
              "company": 1,
              "ivr": null,
              "huntGroup": null,
              "conferenceRoom": null,
              "user": 2,
              "queue": null,
              "conditionalRoute": null,
              "numberCountry": null
          }
      }
    """

  Scenario: Retrieve created IVR excluded extensions
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "ivr_excluded_extensions/2"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
      {
          "id": 2,
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
              "number": "102",
              "routeType": "user",
              "numberValue": null,
              "friendValue": null,
              "id": 2,
              "company": 1,
              "ivr": null,
              "huntGroup": null,
              "conferenceRoom": null,
              "user": 2,
              "queue": null,
              "conditionalRoute": null,
              "numberCountry": null
          }
      }
    """

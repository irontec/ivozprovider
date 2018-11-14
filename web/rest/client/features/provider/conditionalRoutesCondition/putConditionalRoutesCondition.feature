Feature: Update conditional routes conditions
  In order to manage conditional routes conditions
  As an super admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update an conditional routes condition
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/conditional_routes_conditions/1" with body:
    """
      {
          "priority": 1,
          "routeType": "ivr",
          "numberValue": "",
          "friendValue": "",
          "conditionalRoute": 1,
          "ivr": 1,
          "huntGroup": null,
          "voicemailUser": null,
          "user": null,
          "queue": null,
          "locution": null,
          "conferenceRoom": null,
          "extension": null,
          "numberCountry": null
      }
    """
    Then the response status code should be 200
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be equal to:
    """
      {
          "priority": 1,
          "routeType": "ivr",
          "numberValue": null,
          "friendValue": null,
          "id": 1,
          "conditionalRoute": {
              "name": "testConditional",
              "routetype": "user",
              "numbervalue": null,
              "friendvalue": null,
              "id": 1,
              "company": 1,
              "ivr": null,
              "huntGroup": null,
              "voicemailUser": null,
              "user": 1,
              "queue": null,
              "locution": null,
              "conferenceRoom": null,
              "extension": null,
              "numberCountry": null
          },
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
          "huntGroup": null,
          "voicemailUser": null,
          "user": null,
          "queue": null,
          "locution": null,
          "conferenceRoom": null,
          "extension": null,
          "numberCountry": null
      }
    """

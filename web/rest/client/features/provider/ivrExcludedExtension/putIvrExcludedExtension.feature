Feature: Update ivr excluded extensions
  In order to manage ivr excluded extensions
  As an super admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update a ivr excluded extension
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/ivr_excluded_extensions/1" with body:
    """
      {
          "id": 1,
          "ivr": 1,
          "extension": 2
      }
    """
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

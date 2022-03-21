Feature: Update IVRs
  In order to manage IVRs
  As a client admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update an IVR
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/ivrs/1" with body:
    """
      {
          "name": "testIvrCustom",
          "timeout": 6,
          "maxDigits": 0,
          "allowExtensions": false,
          "noInputRouteType": "number",
          "noInputNumberValue": "946002020",
          "errorRouteType": "number",
          "errorNumberValue": "946002021",
          "id": 1,
          "welcomeLocution": 1,
          "noInputLocution": null,
          "errorLocution": null,
          "successLocution": 1,
          "noInputExtension": null,
          "errorExtension": null,
          "noInputVoicemail": null,
          "errorVoicemail": null,
          "noInputNumberCountry": 68,
          "errorNumberCountry": 68,
          "excludedExtensionIds": [
              2
          ]
      }
    """
    Then the response status code should be 200
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be equal to:
    """
     {
          "name": "testIvrCustom",
          "timeout": 6,
          "maxDigits": 0,
          "allowExtensions": false,
          "noInputRouteType": "number",
          "noInputNumberValue": "946002020",
          "errorRouteType": "number",
          "errorNumberValue": "946002021",
          "id": 1,
          "welcomeLocution": 1,
          "noInputLocution": null,
          "errorLocution": null,
          "successLocution": 1,
          "noInputExtension": null,
          "errorExtension": null,
          "noInputVoicemail": null,
          "errorVoicemail": null,
          "noInputNumberCountry": 68,
          "errorNumberCountry": 68,
          "excludedExtensionIds": [
              2
          ]
      }
    """

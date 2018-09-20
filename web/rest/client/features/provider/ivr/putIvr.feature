Feature: Update IVRs
  In order to manage IVRs
  As an super admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update an IVR
    Given I add Authorization header
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
      }
    """
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
          "errorRouteType": "number",
          "errorNumberValue": "946002021",
          "id": 1,
          "company": "~",
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
          "noInputLocution": null,
          "errorLocution": null,
          "successLocution": {
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
          "noInputExtension": null,
          "errorExtension": null,
          "noInputVoiceMailUser": null,
          "errorVoiceMailUser": null,
          "noInputNumberCountry": {
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
          },
          "errorNumberCountry": {
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

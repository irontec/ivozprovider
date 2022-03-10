Feature: Create IVRs
  In order to manage IVRs
  As a client admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create a IVR
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/ivrs" with body:
    """
      {
          "name": "testNewIvrCustom",
          "timeout": 6,
          "maxDigits": 0,
          "allowExtensions": false,
          "noInputRouteType": "number",
          "noInputNumberValue": "946002021",
          "errorRouteType": "number",
          "errorNumberValue": "946002022",
          "id": 1,
          "welcomeLocution": 1,
          "noInputLocution": null,
          "errorLocution": null,
          "successLocution": 1,
          "noInputExtension": null,
          "errorExtension": null,
          "noInputVoicemail": null,
          "errorVoicemail": null,
          "noInputNumberCountry": 2,
          "errorNumberCountry": 3,
          "excludedExtensionIds": [
              1,
              2
          ]
      }
    """
    Then the response status code should be 201
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be equal to:
    """
      {
          "name": "testNewIvrCustom",
          "timeout": 6,
          "maxDigits": 0,
          "allowExtensions": false,
          "noInputRouteType": "number",
          "noInputNumberValue": "946002021",
          "errorRouteType": "number",
          "errorNumberValue": "946002022",
          "id": 3,
          "welcomeLocution": {
              "name": "testLocution",
              "status": null,
              "id": 1,
              "encodedFile": {
                  "fileSize": 1,
                  "mimeType": "audio\/x-wav; charset=binary",
                  "baseName": "locution.wav"
              },
              "originalFile": {
                  "fileSize": 1,
                  "mimeType": "audio\/mpeg; charset=binary",
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
                  "mimeType": "audio\/x-wav; charset=binary",
                  "baseName": "locution.wav"
              },
              "originalFile": {
                  "fileSize": 1,
                  "mimeType": "audio\/mpeg; charset=binary",
                  "baseName": "locution.mp3"
              }
          },
          "noInputExtension": null,
          "errorExtension": null,
          "noInputVoicemail": null,
          "errorVoicemail": null,
          "noInputNumberCountry": {
              "code": "AE",
              "countryCode": "+971",
              "id": 2,
              "name": {
                  "en": "United Arab Emirates",
                  "es": "Emiratos \u00c1rabes Unidos",
                  "ca": "Emiratos \u00c1rabes Unidos",
                  "it": "United Arab Emirates"
              },
              "zone": {
                  "en": "Asia",
                  "es": "Asia",
                  "ca": "Asia",
                  "it": "Asia"
              }
          },
          "errorNumberCountry": {
              "code": "AF",
              "countryCode": "+93",
              "id": 3,
              "name": {
                  "en": "Afghanistan",
                  "es": "Afganist\u00e1n",
                  "ca": "Afganist\u00e1n",
                  "it": "Afghanistan"
              },
              "zone": {
                  "en": "Asia",
                  "es": "Asia",
                  "ca": "Asia",
                  "it": "Asia"
              }
          },
          "excludedExtensionIds": [
              1,
              2
          ]
      }
    """

  Scenario: Retrieve created IVR
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "ivrs/3"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
    """
      {
          "name": "testNewIvrCustom",
          "timeout": 6,
          "maxDigits": 0,
          "allowExtensions": false,
          "noInputRouteType": "number",
          "noInputNumberValue": "946002021",
          "errorRouteType": "number",
          "errorNumberValue": "946002022",
          "id": 3,
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
          "errorVoicemail": null,
          "noInputNumberCountry": {
              "code": "AE",
              "countryCode": "+971",
              "id": 2,
              "name": {
                  "en": "United Arab Emirates",
                  "es": "Emiratos Árabes Unidos",
                  "ca": "Emiratos Árabes Unidos"
              },
              "zone": {
                  "en": "Asia",
                  "es": "Asia",
                  "ca": "Asia"
              }
          },
          "errorNumberCountry": {
              "code": "AF",
              "countryCode": "+93",
              "id": 3,
              "name": {
                  "en": "Afghanistan",
                  "es": "Afganistán",
                  "ca": "Afganistán"
              },
              "zone": {
                  "en": "Asia",
                  "es": "Asia",
                  "ca": "Asia"
              }
          },
          "excludedExtensionIds": [
              1,
              2
          ]
      }
    """

Feature: Create IVRs
  In order to manage IVRs
  As an super admin
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
          "company": 1,
          "welcomeLocution": 1,
          "noInputLocution": null,
          "errorLocution": null,
          "successLocution": 1,
          "noInputExtension": null,
          "errorExtension": null,
          "noInputVoiceMailUser": null,
          "errorVoiceMailUser": null,
          "noInputNumberCountry": 2,
          "errorNumberCountry": 3
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
          "company": 1,
          "welcomeLocution": 1,
          "noInputLocution": null,
          "errorLocution": null,
          "successLocution": 1,
          "noInputExtension": null,
          "errorExtension": null,
          "noInputVoiceMailUser": null,
          "errorVoiceMailUser": null,
          "noInputNumberCountry": 2,
          "errorNumberCountry": 3
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
          "company": {
              "type": "vpbx",
              "name": "DemoCompany",
              "domainUsers": "127.0.0.1",
              "nif": "12345678A",
              "distributeMethod": "hash",
              "maxCalls": 0,
              "postalAddress": "Company Address",
              "postalCode": "54321",
              "town": "Company Town",
              "province": "Company Province",
              "countryName": "Company Country",
              "ipfilter": false,
              "onDemandRecord": 0,
              "onDemandRecordCode": "",
              "externallyextraopts": "",
              "recordingsLimitMB": null,
              "recordingsLimitEmail": "",
              "billingMethod": "prepaid",
              "balance": 1.2,
              "id": 1,
              "language": 1,
              "defaultTimezone": 1,
              "country": 1,
              "outgoingDdi": null,
              "outgoingDdiRule": null
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
                  "mimeType": "audio/mpeg; charset=binary",
                  "baseName": "locution.mp3"
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
                  "fileSize": 1,
                  "mimeType": "audio/x-wav; charset=binary",
                  "baseName": "locution.wav"
              },
              "originalFile": {
                  "fileSize": 1,
                  "mimeType": "audio/mpeg; charset=binary",
                  "baseName": "locution.mp3"
              },
              "company": 1
          },
          "noInputExtension": null,
          "errorExtension": null,
          "noInputVoiceMailUser": null,
          "errorVoiceMailUser": null,
          "noInputNumberCountry": {
              "code": "GB",
              "countryCode": "+44",
              "id": 2,
              "name": {
                  "en": "United Kingdom",
                  "es": "Reino Unido"
              },
              "zone": {
                  "en": "Europe",
                  "es": "Europa"
              }
          },
          "errorNumberCountry": {
              "code": "JP",
              "countryCode": "+81",
              "id": 3,
              "name": {
                  "en": "Japan",
                  "es": "Japón"
              },
              "zone": {
                  "en": "Asia",
                  "es": "Asia"
              }
          }
      }
    """

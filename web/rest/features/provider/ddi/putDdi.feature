Feature: Update Ddis
  In order to manage Ddis
  As an super admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update a Ddi
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/ddis/1" with body:
    """
      {
          "ddi": "1234",
          "ddie164": "+341234",
          "recordCalls": "none",
          "displayName": "",
          "routeType": null,
          "billInboundCalls": false,
          "friendValue": "",
          "company": 2,
          "brand": 1,
          "conferenceRoom": null,
          "language": null,
          "queue": null,
          "externalCallFilter": null,
          "user": null,
          "ivr": null,
          "huntGroup": null,
          "fax": null,
          "peeringContract": 1,
          "country": 1,
          "retailAccount": null,
          "conditionalRoute": null
      }
    """
    Then the response status code should be 200
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be equal to:
    """
      {
          "ddi": "1234",
          "ddie164": "+341234",
          "recordCalls": "none",
          "displayName": "",
          "routeType": null,
          "billInboundCalls": false,
          "friendValue": "",
          "id": 1,
          "company": {
              "type": "vpbx",
              "name": "Irontec Test Company",
              "domainUsers": "test.irontec.com",
              "nif": "12345678-Z",
              "distributeMethod": "hash",
              "externalMaxCalls": 0,
              "postalAddress": "Postal address",
              "postalCode": "PC",
              "town": "Town",
              "province": "Province",
              "countryName": "Country",
              "ipfilter": true,
              "onDemandRecord": 0,
              "onDemandRecordCode": "",
              "externallyextraopts": null,
              "recordingsLimitMB": null,
              "recordingsLimitEmail": null,
              "id": 2,
              "language": 1,
              "mediaRelaySets": 1,
              "defaultTimezone": 1,
              "brand": 1,
              "domain": 5,
              "applicationServer": null,
              "country": 1,
              "transformationRuleSet": 1,
              "outgoingDdi": null,
              "outgoingDdiRule": null
          },
          "brand": {
              "name": "DemoBrand",
              "domainUsers": "",
              "fromName": "",
              "fromAddress": "",
              "recordingsLimitMB": null,
              "recordingsLimitEmail": "",
              "id": 1,
              "logo": {
                  "fileSize": null,
                  "mimeType": null,
                  "baseName": null
              },
              "invoice": {
                  "nif": "",
                  "postalAddress": "",
                  "postalCode": "",
                  "town": "",
                  "province": "",
                  "country": "",
                  "registryData": ""
              },
              "domain": 6,
              "language": 1,
              "defaultTimezone": 1
          },
          "conferenceRoom": null,
          "language": null,
          "queue": null,
          "externalCallFilter": null,
          "user": null,
          "ivr": null,
          "huntGroup": null,
          "fax": null,
          "peeringContract": {
              "description": "Artemis-Dev",
              "name": "Artemis-Dev",
              "externallyRated": false,
              "id": 1,
              "brand": 1,
              "transformationRuleSet": 1
          },
          "country": {
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
          "retailAccount": null,
          "conditionalRoute": null
      }
    """

Feature: Create companies
  In order to manage companies
  As an super admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create a company
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/companies" with body:
    """
      {
        "type": "vpbx",
        "name": "API company",
        "domainUsers": "api.irontec.com",
        "nif": "",
        "distributeMethod": "hash",
        "externalMaxCalls": 0,
        "postalAddress": "",
        "postalCode": "",
        "town": "",
        "province": "",
        "countryName": "",
        "ipfilter": true,
        "onDemandRecord": 0,
        "onDemandRecordCode": "",
        "externallyextraopts": "",
        "recordingsLimitMB": 0,
        "recordingsLimitEmail": "",
        "language": 1,
        "mediaRelaySets": 0,
        "defaultTimezone": 1,
        "brand": 1,
        "domain": 1,
        "applicationServer": 1,
        "country": 1,
        "transformationRuleSet": 1,
        "outgoingDdi": 1,
        "outgoingDdiRule": 1
      }
    """
    Then the response status code should be 201
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be equal to:
    """
      {
          "name": "API company",
          "nif": "",
          "id": 4
      }
    """

  Scenario: Retrieve created company
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "companies/4"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
      {
          "type": "vpbx",
          "name": "API company",
          "domainUsers": "api.irontec.com",
          "nif": "",
          "distributeMethod": "hash",
          "externalMaxCalls": 0,
          "postalAddress": "",
          "postalCode": "",
          "town": "",
          "province": "",
          "countryName": "",
          "ipfilter": true,
          "onDemandRecord": 0,
          "onDemandRecordCode": "",
          "externallyextraopts": "",
          "recordingsLimitMB": 0,
          "recordingsLimitEmail": "",
          "id": 4,
          "language": {
              "iden": "es",
              "id": 1,
              "name": {
                  "en": "es",
                  "es": "es"
              }
          },
          "mediaRelaySets": null,
          "defaultTimezone": {
              "tz": "Europe/Madrid",
              "comment": "mainland",
              "id": 1,
              "label": {
                  "en": "en",
                  "es": "es"
              },
              "country": 1
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
          "domain": {
              "domain": "api.irontec.com",
              "pointsTo": "proxyusers",
              "description": "API company proxyusers domain",
              "id": 1
          },
          "applicationServer": {
              "ip": "127.0.0.1",
              "name": "as001",
              "id": 1
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
          "transformationRuleSet": {
              "description": "Generic transformation for Spain",
              "internationalCode": "00",
              "trunkPrefix": "",
              "areaCode": "",
              "nationalLen": 9,
              "generateRules": false,
              "id": 1,
              "name": {
                  "en": "en",
                  "es": "es"
              },
              "brand": null,
              "country": 1
          },
          "outgoingDdi": {
              "ddi": "123",
              "ddie164": "+34123",
              "recordCalls": "none",
              "displayName": "",
              "routeType": null,
              "billInboundCalls": false,
              "friendValue": "",
              "id": 1,
              "company": 1,
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
          },
          "outgoingDdiRule": {
              "name": "testRule",
              "defaultAction": "keep",
              "id": 1,
              "company": 1,
              "forcedDdi": null
          }
      }
    """

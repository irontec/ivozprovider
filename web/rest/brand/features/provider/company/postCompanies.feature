Feature: Create companies
  In order to manage companies
  As an super admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create a company
    Given I add Brand Authorization header
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
        "maxCalls": 0,
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
        "mediaRelaySets": 1,
        "defaultTimezone": 1,
        "brand": 1,
        "domain": 1,
        "applicationServer": 1,
        "country": 1,
        "transformationRuleSet": 1,
        "outgoingDdi": 1,
        "outgoingDdiRule": 1,
        "voicemailNotificationTemplate": 1,
        "faxNotificationTemplate": null
      }
    """
    Then the response status code should be 201
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
          "maxCalls": 0,
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
          "billingMethod": "postpaid",
          "balance": 0,
          "showInvoices": false,
          "id": 6,
          "language": 1,
          "defaultTimezone": 1,
          "brand": 1,
          "domain": 1,
          "country": 1,
          "currency": null,
          "transformationRuleSet": 1,
          "voicemailNotificationTemplate": 1,
          "faxNotificationTemplate": null,
          "invoiceNotificationTemplate": null,
          "callCsvNotificationTemplate": null
      }
    """

  Scenario: Retrieve created company
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "companies/6"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
    """
      {
          "type": "vpbx",
          "name": "API company",
          "domainUsers": "api.irontec.com",
          "nif": "",
          "distributeMethod": "hash",
          "maxCalls": 0,
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
          "billingMethod": "postpaid",
          "balance": 0,
          "showInvoices": false,
          "id": 6,
          "language": {
              "iden": "es",
              "id": 1,
              "name": {
                  "en": "es",
                  "es": "es"
              }
          },
          "defaultTimezone": {
              "tz": "Europe/Andorra",
              "comment": "",
              "id": 1,
              "label": {
                  "en": "",
                  "es": ""
              },
              "country": 1
          },
          "brand": {
              "name": "DemoBrand",
              "domainUsers": "",
              "recordingsLimitMB": null,
              "recordingsLimitEmail": "",
              "maxCalls": 0,
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
              "defaultTimezone": 145,
              "currency": 2
          },
          "domain": {
              "domain": "api.irontec.com",
              "pointsTo": "proxyusers",
              "description": "API company proxyusers domain",
              "id": 1
          },
          "country": {
              "code": "AD",
              "countryCode": "+376",
              "id": 1,
              "name": {
                  "en": "Andorra",
                  "es": "Andorra"
              },
              "zone": {
                  "en": "Europe",
                  "es": "Andorra"
              }
          },
          "currency": null,
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
              "country": 68
          },
          "voicemailNotificationTemplate": {
              "name": "Voicemail notification",
              "type": "voicemail",
              "id": 1,
              "brand": 1
          },
          "faxNotificationTemplate": null,
          "invoiceNotificationTemplate": null,
          "callCsvNotificationTemplate": null
      }
    """

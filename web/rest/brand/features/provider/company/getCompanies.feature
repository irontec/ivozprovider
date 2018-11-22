Feature: Retrieve companies
  In order to manage company
  As an super admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the company json list
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "companies"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
      [
          {
              "name": "DemoCompany",
              "nif": "12345678A",
              "id": 1
          },
          {
              "name": "Irontec Test Company",
              "nif": "12345678-Z",
              "id": 2
          },
          {
              "name": "Retail Company",
              "nif": "12345679-Z",
              "id": 3
          }
      ]
    """

  Scenario: Retrieve certain company json
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "companies/1"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
    """
      {
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
          "language": {
              "iden": "es",
              "id": 1,
              "name": {
                  "en": "es",
                  "es": "es"
              }
          },
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
              "defaultTimezone": 1
          },
          "domain": {
              "domain": "127.0.0.1",
              "pointsTo": "proxyusers",
              "description": "DemoCompany proxyusers domain",
              "id": 3
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

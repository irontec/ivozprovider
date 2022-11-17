Feature: Retrieve companies
  In order to manage company
  As a brand admin
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
              "type": "vpbx",
              "name": "DemoCompany",
              "domainUsers": "127.0.0.1",
              "nif": "12345678A",
              "maxDailyUsage": 2,
              "currentDayUsage": 1,
              "billingMethod": "prepaid",
              "balance": 1.2,
              "id": 1,
              "outgoingDdi": null,
              "featureIds": [
                  1,
                  2,
                  3,
                  4,
                  5
              ],
              "geoIpAllowedCountries": [],
              "routingTagIds": [],
              "codecIds": []
          },
          {
              "type": "vpbx",
              "name": "Irontec Test Company",
              "domainUsers": "test.irontec.com",
              "nif": "12345678-Z",
              "maxDailyUsage": 1000000,
              "currentDayUsage": 0,
              "billingMethod": "postpaid",
              "balance": 0,
              "id": 2,
              "outgoingDdi": null,
              "featureIds": [],
              "geoIpAllowedCountries": [],
              "routingTagIds": [],
              "codecIds": []
          },
          {
              "type": "retail",
              "name": "Retail Company",
              "domainUsers": null,
              "nif": "12345679-Z",
              "maxDailyUsage": 1000000,
              "currentDayUsage": 0,
              "billingMethod": "postpaid",
              "balance": 0,
              "id": 3,
              "outgoingDdi": null,
              "featureIds": [],
              "geoIpAllowedCountries": [],
              "routingTagIds": [
                  1
              ],
              "codecIds": []
          },
          {
              "type": "residential",
              "name": "Residential Company",
              "domainUsers": null,
              "nif": "12345679-Z",
              "maxDailyUsage": 1000000,
              "currentDayUsage": 0,
              "billingMethod": "postpaid",
              "balance": 0,
              "id": 4,
              "outgoingDdi": null,
              "featureIds": [],
              "geoIpAllowedCountries": [],
              "routingTagIds": [],
              "codecIds": []
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
      And the JSON should be equal to:
    """
      {
          "type": "vpbx",
          "name": "DemoCompany",
          "domainUsers": "127.0.0.1",
          "nif": "12345678A",
          "maxCalls": 0,
          "maxDailyUsage": 2,
          "currentDayUsage": 1,
          "maxDailyUsageEmail": "no-replay@domain.net",
          "postalAddress": "Company Address",
          "postalCode": "54321",
          "town": "Company Town",
          "province": "Company Province",
          "countryName": "Company Country",
          "ipfilter": false,
          "onDemandRecord": 0,
          "allowRecordingRemoval": true,
          "onDemandRecordCode": "",
          "externallyextraopts": "",
          "billingMethod": "prepaid",
          "balance": 1.2,
          "showInvoices": true,
          "id": 1,
          "language": {
              "iden": "es",
              "id": 1,
              "name": {
                  "en": "es",
                  "es": "es",
                  "ca": "es",
                  "it": "es"
              }
          },
          "defaultTimezone": {
              "tz": "Europe/Madrid",
              "comment": "mainland",
              "id": 145,
              "label": {
                  "en": "en",
                  "es": "es",
                  "ca": "ca",
                  "it": "it"
              },
              "country": 68
          },
          "country": {
              "code": "ES",
              "countryCode": "+34",
              "id": 68,
              "name": {
                  "en": "Spain",
                  "es": "España",
                  "ca": "España",
                  "it": "Spagna"
              },
              "zone": {
                  "en": "Europe",
                  "es": "Europa",
                  "ca": "Europa",
                  "it": "Europe"
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
                  "es": "es",
                  "ca": "ca",
                  "it": "it"
              },
              "country": 68,
              "editable": true
          },
          "outgoingDdi": null,
          "outgoingDdiRule": null,
          "voicemailNotificationTemplate": {
              "name": "Voicemail notification",
              "type": "voicemail",
              "id": 1
          },
          "faxNotificationTemplate": null,
          "invoiceNotificationTemplate": null,
          "callCsvNotificationTemplate": null,
          "maxDailyUsageNotificationTemplate": {
              "name": "CallCsv notification",
              "type": "callCsv",
              "id": 2
          },
          "featureIds": [
              1,
              2,
              3,
              4,
              5
          ],
          "geoIpAllowedCountries": [],
          "routingTagIds": [],
          "codecIds": []
      }
    """

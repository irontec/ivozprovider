Feature: Retrieve features rel brand
  In order to manage features rel brand
  As an brand admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the features json list
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "features_rel_companies"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
      """
      [
          {
              "id": 1,
              "company": {
                  "type": "vpbx",
                  "name": "DemoCompany",
                  "domainUsers": "127.0.0.1",
                  "maxCalls": 0,
                  "maxDailyUsage": 2,
                  "currentDayUsage": 1,
                  "maxDailyUsageEmail": "no-replay@domain.net",
                  "ipfilter": false,
                  "onDemandRecord": 0,
                  "allowRecordingRemoval": true,
                  "onDemandRecordCode": "",
                  "externallyextraopts": "",
                  "billingMethod": "prepaid",
                  "balance": 1.2,
                  "showInvoices": true,
                  "id": 1,
                  "invoicing": {
                      "nif": "12345678A",
                      "postalAddress": "Company Address",
                      "postalCode": "54321",
                      "town": "Company Town",
                      "province": "Company Province",
                      "countryName": "Company Country"
                  },
                  "language": 1,
                  "defaultTimezone": 145,
                  "country": 68,
                  "currency": null,
                  "transformationRuleSet": 1,
                  "outgoingDdi": null,
                  "outgoingDdiRule": null,
                  "voicemailNotificationTemplate": 1,
                  "faxNotificationTemplate": null,
                  "invoiceNotificationTemplate": null,
                  "callCsvNotificationTemplate": null,
                  "maxDailyUsageNotificationTemplate": 2,
                  "featureIds": [],
                  "geoIpAllowedCountries": [],
                  "routingTagIds": [],
                  "codecIds": []
              },
              "feature": {
                  "iden": "queues",
                  "id": 1,
                  "name": {
                      "en": "en",
                      "es": "es",
                      "ca": "ca",
                      "it": "it"
                  }
              }
          },
          {
              "id": 2,
              "company": "~",
              "feature": "~"
          },
          {
              "id": 3,
              "company": "~",
              "feature": "~"
          },
          {
              "id": 4,
              "company": "~",
              "feature": "~"
          },
          {
              "id": 5,
              "company": "~",
              "feature": "~"
          }
      ]
      """

  Scenario: Retrieve certain feature json
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "features_rel_companies/1"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      {
          "id": 1,
          "company": {
              "type": "vpbx",
              "name": "DemoCompany",
              "domainUsers": "127.0.0.1",
              "maxCalls": 0,
              "maxDailyUsage": 2,
              "currentDayUsage": 1,
              "maxDailyUsageEmail": "no-replay@domain.net",
              "ipfilter": false,
              "onDemandRecord": 0,
              "allowRecordingRemoval": true,
              "onDemandRecordCode": "",
              "externallyextraopts": "",
              "billingMethod": "prepaid",
              "balance": 1.2,
              "showInvoices": true,
              "id": 1,
              "invoicing": {
                  "nif": "12345678A",
                  "postalAddress": "Company Address",
                  "postalCode": "54321",
                  "town": "Company Town",
                  "province": "Company Province",
                  "countryName": "Company Country"
              },
              "language": 1,
              "defaultTimezone": 145,
              "country": 68,
              "currency": null,
              "transformationRuleSet": 1,
              "outgoingDdi": null,
              "outgoingDdiRule": null,
              "voicemailNotificationTemplate": 1,
              "faxNotificationTemplate": null,
              "invoiceNotificationTemplate": null,
              "callCsvNotificationTemplate": null,
              "maxDailyUsageNotificationTemplate": 2,
              "accessCredentialNotificationTemplate": 5,
              "corporation": 1,
              "applicationServerSet": 1,
              "mediaRelaySet": 0,
              "location": 1,
              "featureIds": [],
              "geoIpAllowedCountries": [],
              "routingTagIds": [],
              "codecIds": []
          },
          "feature": {
              "iden": "queues",
              "id": 1,
              "name": {
                  "en": "en",
                  "es": "es",
                  "ca": "ca",
                  "it": "it"
              }
          }
      }
      """

Feature: Retrieve webhooks
  In order to manage webhooks
  As a brand admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the webhooks json list
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "/webhooks"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      [
          {
              "name": "Brand Level Webhook",
              "description": null,
              "uri": "https://webhook.brand.com/events",
              "eventStart": true,
              "eventRing": false,
              "eventAnswer": false,
              "eventEnd": true,
              "template": "{\"event\": \"{event}\", \"brand\": \"{brandId}\"}",
              "id": 4
          },
          {
              "name": "Answer Webhook Company 1",
              "description": null,
              "uri": "https://webhook.company1.com/answer",
              "eventStart": false,
              "eventRing": false,
              "eventAnswer": true,
              "eventEnd": false,
              "template": "{\"event\": \"answer\", \"callId\": \"{callId}\"}",
              "id": 2
          },
          {
              "name": "DDI Specific Webhook",
              "description": null,
              "uri": "https://webhook.ddi.com/123456",
              "eventStart": false,
              "eventRing": true,
              "eventAnswer": false,
              "eventEnd": false,
              "template": "{\"event\": \"ring\", \"ddi\": \"{ddiId}\"}",
              "id": 5
          },
          {
              "name": "Start Webhook Company 1",
              "description": null,
              "uri": "https://webhook.company1.com/start",
              "eventStart": true,
              "eventRing": false,
              "eventAnswer": false,
              "eventEnd": false,
              "template": "{\"event\": \"start\", \"callId\": \"{callId}\"}",
              "id": 1
          },
          {
              "name": "All Events Webhook Company 2",
              "description": null,
              "uri": "https://webhook.company2.com/all",
              "eventStart": true,
              "eventRing": true,
              "eventAnswer": true,
              "eventEnd": true,
              "template": "{\"event\": \"{event}\", \"callId\": \"{callId}\"}",
              "id": 3
          }
      ]
      """

  Scenario: Retrieve company-level webhook json
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "/webhooks/1"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      {
          "name": "Start Webhook Company 1",
          "description": null,
          "uri": "https://webhook.company1.com/start",
          "eventStart": true,
          "eventRing": false,
          "eventAnswer": false,
          "eventEnd": false,
          "template": "{\"event\": \"start\", \"callId\": \"{callId}\"}",
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
          "ddi": null
      }
      """

  Scenario: Retrieve DDI-specific webhook json
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "/webhooks/5"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      {
          "name": "DDI Specific Webhook",
          "description": null,
          "uri": "https://webhook.ddi.com/123456",
          "eventStart": false,
          "eventRing": true,
          "eventAnswer": false,
          "eventEnd": false,
          "template": "{\"event\": \"ring\", \"ddi\": \"{ddiId}\"}",
          "id": 5,
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
          "ddi": {
              "ddi": "123",
              "ddie164": "+34123",
              "description": "Description for DDI 123",
              "type": "inout",
              "useDdiProviderRoutingTag": true,
              "id": 1,
              "company": 1,
              "ddiProvider": 1,
              "country": 68,
              "routingTag": null
          }
      }
      """

  Scenario: Retrieve multi-event webhook json
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "/webhooks/3"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      {
          "name": "All Events Webhook Company 2",
          "description": null,
          "uri": "https://webhook.company2.com/all",
          "eventStart": true,
          "eventRing": true,
          "eventAnswer": true,
          "eventEnd": true,
          "template": "{\"event\": \"{event}\", \"callId\": \"{callId}\"}",
          "id": 3,
          "company": {
              "type": "vpbx",
              "name": "Irontec Test Company",
              "domainUsers": "test.irontec.com",
              "maxCalls": 0,
              "maxDailyUsage": 1000000,
              "currentDayUsage": 0,
              "maxDailyUsageEmail": null,
              "ipfilter": true,
              "onDemandRecord": 0,
              "allowRecordingRemoval": true,
              "onDemandRecordCode": "",
              "externallyextraopts": null,
              "billingMethod": "postpaid",
              "balance": 0,
              "showInvoices": false,
              "id": 2,
              "invoicing": {
                  "nif": "12345678-Z",
                  "postalAddress": "Postal address",
                  "postalCode": "PC",
                  "town": "Town",
                  "province": "Province",
                  "countryName": "Country"
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
              "maxDailyUsageNotificationTemplate": null,
              "accessCredentialNotificationTemplate": null,
              "corporation": 1,
              "applicationServerSet": 1,
              "mediaRelaySet": 0,
              "location": null,
              "featureIds": [],
              "geoIpAllowedCountries": [],
              "routingTagIds": [],
              "codecIds": []
          },
          "ddi": null
      }
      """

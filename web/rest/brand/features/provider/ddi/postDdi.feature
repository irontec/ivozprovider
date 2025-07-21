Feature: Create ddis
  In order to manage ddis
  As a brand admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create a ddi
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/ddis" with body:
      """
      {
          "ddi": "321",
          "description": "Description for 321",
          "type": "inout",
          "company": 1,
          "ddiProvider": 1,
          "country": 68
      }
      """
     Then the response status code should be 201
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      {
          "ddi": "321",
          "ddie164": "+34321",
          "description": "Description for 321",
          "type": "inout",
          "useDdiProviderRoutingTag": true,
          "id": 6,
          "company": 1,
          "ddiProvider": 1,
          "country": 68,
          "routingTag": null
      }
      """

  Scenario: Retrieve created ddi
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "ddis/4"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
      """
      {
          "ddi": "125",
          "ddie164": "+34125",
          "description": null,
          "type": "inout",
          "useDdiProviderRoutingTag": true,
          "id": 4,
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
          "ddiProvider": {
              "description": "DDIProviderDescription",
              "name": "DDIProviderName",
              "id": 1,
              "transformationRuleSet": 1,
              "proxyTrunk": 1,
              "mediaRelaySet": 0,
              "routingTag": 2
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
          "routingTag": null
      }
      """

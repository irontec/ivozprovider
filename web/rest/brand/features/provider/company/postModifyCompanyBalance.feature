Feature: Modify company balances
  In order to manage company balances
  As a brand admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Increment a company balance
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/x-www-form-urlencoded"
      And I add "Accept" header equal to "application/json"
     When I send a "POST" request to "/companies/1/modify_balance" with parameters:
      | key       | value     |
      | operation | increment |
      | amount    | 10        |
     Then the response status code should be 201
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
      """
      {
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
          "balance": 11.2,
          "showInvoices": true,
          "id": 1,
          "invoicing": {
              "nif": "12345678A",
              "*": "~"
          },
          "language": {
              "iden": "es",
              "*": "~"
          },
          "defaultTimezone": {
              "country": 68,
              "*": "~"
          },
          "country": {
              "countryCode": "+34",
              "*": "~"
          },
          "currency": null,
          "transformationRuleSet": {
              "country": 68,
              "*": "~"
          },
          "outgoingDdi": null,
          "outgoingDdiRule": null,
          "voicemailNotificationTemplate": {
              "type": "voicemail",
              "*": "~"
          },
          "faxNotificationTemplate": null,
          "invoiceNotificationTemplate": null,
          "callCsvNotificationTemplate": null,
          "maxDailyUsageNotificationTemplate": {
              "type": "callCsv",
              "*": "~"
          },
          "accessCredentialNotificationTemplate": {
              "type": "accessCredentials",
              "*": "~"
          },
          "corporation": {
              "id": 1,
              "*": "~"
          },
          "applicationServerSet": {
              "id": 1,
              "*": "~"
          },
          "mediaRelaySet": {
              "id": 0,
              "*": "~"
          },
          "location": {
              "id": 1,
              "*": "~"
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

  @createSchema
  Scenario: Decrement a company balance
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/x-www-form-urlencoded"
      And I add "Accept" header equal to "application/json"
     When I send a "POST" request to "/companies/1/modify_balance" with parameters:
      | key       | value     |
      | operation | decrement |
      | amount    | 1         |
     Then the response status code should be 201
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
      """
      {
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
          "balance": 0.2,
          "showInvoices": true,
          "id": 1,
          "invoicing": {
              "countryName": "Company Country",
              "*": "~"
          },
          "language": {
              "iden": "es",
              "id": 1,
              "*": "~"
          },
          "defaultTimezone": {
              "country": 68,
              "*": "~"
          },
          "country": {
              "countryCode": "+34",
              "*": "~"
          },
          "currency": null,
          "transformationRuleSet": {
              "country": 68,
              "*": "~"
          },
          "outgoingDdi": null,
          "outgoingDdiRule": null,
          "voicemailNotificationTemplate": {
              "type": "voicemail",
              "*": "~"
          },
          "faxNotificationTemplate": null,
          "invoiceNotificationTemplate": null,
          "callCsvNotificationTemplate": null,
          "maxDailyUsageNotificationTemplate": {
              "type": "callCsv",
              "*": "~"
          },
          "accessCredentialNotificationTemplate": {
              "type": "accessCredentials",
              "*": "~"
          },
          "corporation": {
              "name": "Irontec Test Corporation",
              "*": "~"
          },
          "applicationServerSet": {
              "name": "BlueApSet",
              "*": "~"
          },
          "mediaRelaySet": {
              "name": "Default",
              "*": "~"
          },
          "location": {
              "name": "testLocation",
              "*": "~"
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

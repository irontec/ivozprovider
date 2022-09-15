Feature: Update company
  In order to manage call forward settings
  As a brand admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update a company
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/companies/1" with body:
    """
      {
          "type": "vpbx",
          "name": "DemoCompanyUpdated",
          "domainUsers": "127.0.0.1",
          "nif": "12345678B",
          "distributeMethod": "hash",
          "maxCalls": 0,
          "maxDailyUsage": 100,
          "maxDailyUsageEmail": "no-replay-updated@domain.net",
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
          "billingMethod": "postpaid",
          "balance": 0,
          "showInvoices": false,
          "id": 1,
          "language": 1,
          "mediaRelaySets": 1,
          "defaultTimezone": 1,
          "applicationServer": null,
          "country": 68,
          "transformationRuleSet": 1,
          "outgoingDdi": null,
          "outgoingDdiRule": null,
          "voicemailNotificationTemplate": 1,
          "faxNotificationTemplate": null,
          "featureIds": [
              3
          ]
      }
    """
    Then the response status code should be 200
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be equal to:
    """
      {
          "type": "vpbx",
          "name": "DemoCompanyUpdated",
          "domainUsers": "127.0.0.1",
          "nif": "12345678B",
          "maxCalls": 0,
          "maxDailyUsage": 100,
          "currentDayUsage": 1,
          "maxDailyUsageEmail": "no-replay-updated@domain.net",
          "postalAddress": "Company Address",
          "postalCode": "54321",
          "town": "Company Town",
          "province": "Company Province",
          "countryName": "Company Country",
          "ipfilter": false,
          "onDemandRecord": 0,
          "onDemandRecordCode": "",
          "externallyextraopts": "",
          "billingMethod": "postpaid",
          "balance": 1.2,
          "showInvoices": false,
          "id": 1,
          "language": 1,
          "defaultTimezone": 1,
          "country": 68,
          "currency": null,
          "transformationRuleSet": 1,
          "outgoingDdi": null,
          "voicemailNotificationTemplate": 1,
          "faxNotificationTemplate": null,
          "invoiceNotificationTemplate": null,
          "callCsvNotificationTemplate": null,
          "featureIds": [
              3
          ]
      }
    """

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
          "invoicing": {
            "nif": "12345678B",
            "postalAddress": "Company Address",
            "postalCode": "54321",
            "town": "Company Town",
            "province": "Company Province",
            "countryName": "Company Country"
          },
          "distributeMethod": "hash",
          "maxCalls": 0,
          "maxDailyUsage": 100,
          "maxDailyUsageEmail": "no-replay-updated@domain.net",
          "ipfilter": false,
          "onDemandRecord": 0,
          "onDemandRecordCode": "",
          "externallyextraopts": "",
          "recordingsLimitMB": null,
          "recordingsLimitEmail": "",
          "billingMethod": "postpaid",
          "balance": 0,
          "showInvoices": false,
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
          "accessCredentialNotificationTemplate": 5,
          "featureIds": [
              3
          ],
          "geoIpAllowedCountries": [
            1
          ],
          "mediaRelaySet": 1,
          "applicationServerSet": 1
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
          "maxCalls": 0,
          "maxDailyUsage": 100,
          "currentDayUsage": 1,
          "maxDailyUsageEmail": "no-replay-updated@domain.net",
          "ipfilter": false,
          "onDemandRecord": 0,
          "allowRecordingRemoval": true,
          "onDemandRecordCode": "",
          "externallyextraopts": "",
          "billingMethod": "postpaid",
          "balance": 1.2,
          "showInvoices": false,
          "id": 1,
          "invoicing": {
              "nif": "12345678B",
              "postalAddress": "Company Address",
              "postalCode": "54321",
              "town": "Company Town",
              "province": "Company Province",
              "countryName": "Company Country"
          },
          "language": 1,
          "defaultTimezone": 1,
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
          "mediaRelaySet": 1,
          "location": 2,
          "featureIds": [
              3
          ],
          "geoIpAllowedCountries": [
              1
          ],
          "routingTagIds": [],
          "codecIds": []
      }
      """

  @createSchema
  Scenario: Update a company with unrelated application server set
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/companies/1" with body:
      """
      {
        "applicationServerSet": 3
      }
      """
     Then the response status code should be 403
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/problem+json; charset=utf-8"
      And the JSON should be like:
      """
      {
        "detail": "Rejected request during security check"
      }
      """

  @createSchema
  Scenario: Update a company with unrelated media relay set
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/companies/1" with body:
      """
      {
        "mediaRelaySet": 2
      }
      """
     Then the response status code should be 403
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/problem+json; charset=utf-8"
      And the JSON should be like:
      """
      {
        "detail": "Rejected request during security check"
      }
      """

  @createSchema
  Scenario: Update a company with null application server set
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/companies/1" with body:
      """
      {
        "applicationServerSet": null
      }
      """
     Then the response status code should be 400
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/problem+json; charset=utf-8"
      And the JSON should be like:
      """
      {
        "detail": "getApplicationServerSet value is null, but non null value was expected."
      }
      """

  @createSchema
  Scenario: Update a company with null media relay set
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/companies/1" with body:
      """
      {
        "mediaRelaySet": null
      }
      """
     Then the response status code should be 400
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/problem+json; charset=utf-8"
      And the JSON should be like:
      """
      {
        "detail": "getMediaRelaySet value is null, but non null value was expected."
      }
      """

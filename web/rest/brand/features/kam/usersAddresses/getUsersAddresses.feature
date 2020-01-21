Feature: Retrieve Users addresses
  In order to manage Users addresses
  As a brand admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the Users addresses json list
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "users_addresses"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
      [
          {
              "sourceAddress": "127.0.0.1",
              "description": "Irontec HQ",
              "id": 1,
              "company": 1
          }
      ]
    """

  Scenario: Retrieve certain administrator json
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "users_addresses/1"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
    """
      {
          "sourceAddress": "127.0.0.1",
          "description": "Irontec HQ",
          "id": 1,
          "company": {
              "type": "vpbx",
              "name": "DemoCompany",
              "domainUsers": "127.0.0.1",
              "nif": "12345678A",
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
              "billingMethod": "prepaid",
              "balance": 1.2,
              "showInvoices": false,
              "id": 1,
              "language": 1,
              "defaultTimezone": 145,
              "country": 68,
              "currency": null,
              "transformationRuleSet": 1,
              "outgoingDdi": null,
              "voicemailNotificationTemplate": 1,
              "faxNotificationTemplate": null,
              "invoiceNotificationTemplate": null,
              "callCsvNotificationTemplate": null
          }
      }
    """

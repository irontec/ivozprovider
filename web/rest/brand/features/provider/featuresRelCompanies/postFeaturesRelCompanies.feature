  Feature: Create features rel companies
  In order to manage features rel companies
  As an super admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create a features rel companies
    Given I add Brand Authorization header
    When I add "Content-Type" header equal to "application/json"
    And I add "Accept" header equal to "application/json"
    And I send a "POST" request to "/features_rel_companies" with body:
    """
      {
          "id": 1,
          "company": 1,
          "feature": 8
      }
    """
    Then the response status code should be 201
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      {
          "id": 6,
          "company": {
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
              "showInvoices": false,
              "id": 1,
              "language": 1,
              "defaultTimezone": 1,
              "brand": 1,
              "domain": 3,
              "country": 1,
              "currency": null,
              "transformationRuleSet": 1,
              "voicemailNotificationTemplate": 1,
              "faxNotificationTemplate": null,
              "invoiceNotificationTemplate": null,
              "callCsvNotificationTemplate": null
          },
          "feature": {
              "iden": "progress",
              "id": 8,
              "name": {
                  "en": "en",
                  "es": "es"
              }
          }
      }
    """

  Scenario: Retrieve created features rel companies
    Given I add Brand Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "features_rel_companies/2"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be like:
    """
       {
          "id": 2,
          "company": {
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
              "showInvoices": false,
              "id": 1,
              "language": 1,
              "defaultTimezone": 1,
              "brand": 1,
              "domain": 3,
              "country": 1,
              "currency": null,
              "transformationRuleSet": 1,
              "voicemailNotificationTemplate": 1,
              "faxNotificationTemplate": null,
              "invoiceNotificationTemplate": null,
              "callCsvNotificationTemplate": null
          },
          "feature": {
              "iden": "recordings",
              "id": 2,
              "name": {
                  "en": "en",
                  "es": "es"
              }
          }
      }
    """

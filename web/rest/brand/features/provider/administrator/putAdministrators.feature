Feature: Update administrators
  In order to manage administrators
  As an super admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update an administrators
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/administrators/4" with body:
    """
      {
          "username": "newUserName",
          "pass": "1234",
          "email": "modified@example.com",
          "active": false,
          "name": "Updated admin name",
          "lastname": "a lastname",
          "brand": 1,
          "company": 1,
          "timezone": 2
      }
    """
    Then the response status code should be 200
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be equal to:
    """
      {
          "username": "newUserName",
          "pass": "****",
          "email": "modified@example.com",
          "active": false,
          "name": "Updated admin name",
          "lastname": "a lastname",
          "id": 4,
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
              "transformationRuleSet": 1,
              "voicemailNotificationTemplate": 1,
              "faxNotificationTemplate": null,
              "invoiceNotificationTemplate": null
          },
          "timezone": {
              "tz": "Europe\/London",
              "comment": null,
              "id": 2,
              "label": {
                  "en": "en",
                  "es": "es"
              },
              "country": 2
          }
      }
    """

  @createSchema
  Scenario: Fails on unauthorized company
    Given I add Brand Authorization header
    When I add "Content-Type" header equal to "application/json"
    And I add "Accept" header equal to "application/json"
    And I send a "PUT" request to "/administrators/4" with body:
    """
      {
          "username": "newUserName",
          "pass": "1234",
          "email": "modified@example.com",
          "active": false,
          "name": "Updated admin name",
          "lastname": "a lastname",
          "brand": 1,
          "company": 99,
          "timezone": 2
      }
    """
    Then the response status code should be 403
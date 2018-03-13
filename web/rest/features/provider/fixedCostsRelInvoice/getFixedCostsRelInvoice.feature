Feature: Retrieve fixed costs rel invoices
  In order to manage fixed costs rel invoices
  As an super admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the fixed costs rel invoices json list
    Given I add Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "fixed_costs_rel_invoices"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      [
          {
              "quantity": 1,
              "id": 1,
              "brand": {
                  "name": "DemoBrand",
                  "domainUsers": "",
                  "fromName": "",
                  "fromAddress": "",
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
              "fixedCost": {
                  "name": "Monitoring",
                  "description": "Something",
                  "cost": "1",
                  "id": 1,
                  "brand": 1
              },
              "invoice": {
                  "number": "1",
                  "inDate": "2018-01-01 00:00:00",
                  "outDate": "2018-01-31 00:00:00",
                  "total": "0.272",
                  "taxRate": "21",
                  "totalWithTax": "0.33",
                  "status": "processing",
                  "id": 1,
                  "pdf": {
                      "fileSize": null,
                      "mimeType": null,
                      "baseName": null
                  },
                  "invoiceTemplate": 1,
                  "brand": 1,
                  "company": 1
              }
          }
      ]
    """

  Scenario: Retrieve certain fixed costs rel invoice json
    Given I add Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "fixed_costs_rel_invoices/1"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      {
          "quantity": 1,
          "id": 1,
          "brand": {
              "name": "DemoBrand",
              "domainUsers": "",
              "fromName": "",
              "fromAddress": "",
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
          "fixedCost": {
              "name": "Monitoring",
              "description": "Something",
              "cost": "1",
              "id": 1,
              "brand": 1
          },
          "invoice": {
              "number": "1",
              "inDate": "2018-01-01 00:00:00",
              "outDate": "2018-01-31 00:00:00",
              "total": "0.272",
              "taxRate": "21",
              "totalWithTax": "0.33",
              "status": "processing",
              "id": 1,
              "pdf": {
                  "fileSize": null,
                  "mimeType": null,
                  "baseName": null
              },
              "invoiceTemplate": 1,
              "brand": 1,
              "company": 1
          }
      }
    """

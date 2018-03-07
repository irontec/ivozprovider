Feature: Update fixed costs rel invoices
  In order to manage fixed costs rel invoices
  As an super admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update a fixed cost rel invoice
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/fixed_costs_rel_invoices/1" with body:
    """
      {
          "quantity": 2,
          "id": 1,
          "brand": 1,
          "fixedCost": 1,
          "invoice": 1
      }
    """
    Then the response status code should be 200
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be equal to:
    """
      {
          "quantity": 2,
          "id": 1,
          "brand": {
              "name": "DemoBrand",
              "domainUsers": "",
              "fromName": "",
              "fromAddress": "",
              "recordingsLimitMB": null,
              "recordingsLimitEmail": "",
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

Feature: Create fixed costs rel invoices
  In order to manage fixed costs rel invoices
  As an super admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create a fixed cost rel invoice
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/fixed_costs_rel_invoices" with body:
    """
      {
          "quantity": 1,
          "fixedCost": 1,
          "invoice": 1
      }
    """
    Then the response status code should be 201
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be equal to:
    """
      {
          "quantity": 1,
          "id": 2,
          "fixedCost": {
              "name": "Monitoring",
              "description": "Something",
              "cost": 1,
              "id": 1,
              "brand": 1
          },
          "invoice": {
              "number": "1",
              "inDate": "2018-01-01 01:00:00",
              "outDate": "2018-01-31 01:00:00",
              "total": 0.272,
              "taxRate": 21,
              "totalWithTax": 0.33,
              "status": "processing",
              "statusMsg": null,
              "id": 1,
              "pdf": {
                  "fileSize": null,
                  "mimeType": null,
                  "baseName": null
              },
              "invoiceTemplate": 1,
              "brand": 1,
              "company": 1,
              "numberSequence": null,
              "scheduler": null
          }
      }
    """

  Scenario: Retrieve created fixed cost rel invoice
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "fixed_costs_rel_invoices/2"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
    """
      {
          "quantity": 1,
          "id": 2,
          "fixedCost": {
              "name": "Monitoring",
              "description": "Something",
              "cost": 1,
              "id": 1,
              "brand": 1
          },
          "invoice": {
              "number": "1",
              "inDate": "2018-01-01 01:00:00",
              "outDate": "2018-01-31 01:00:00",
              "total": 0.272,
              "taxRate": 21,
              "totalWithTax": 0.33,
              "status": "processing",
              "statusMsg": null,
              "id": 1,
              "pdf": {
                  "fileSize": null,
                  "mimeType": null,
                  "baseName": null
              },
              "invoiceTemplate": 1,
              "brand": 1,
              "company": 1,
              "numberSequence": null,
              "scheduler": null
          }
      }
    """

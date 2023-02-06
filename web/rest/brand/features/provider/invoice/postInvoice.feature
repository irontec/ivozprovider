Feature: Create invoice
  In order to manage invoice
  As a brand admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create an invoice number sequence
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/invoices" with body:
      """
      {
          "number": "2",
          "inDate": "2019-01-01 01:00:00",
          "outDate": "2019-01-31 23:59:59",
          "total": 10,
          "taxRate": 21,
          "totalWithTax": 12.1,
          "status": "created",
          "statusMsg": null,
          "invoiceTemplate": 1,
          "company": 1,
          "numberSequence": null
      }
      """
     Then the response status code should be 201
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      {
          "number": "2",
          "inDate": "2019-01-01 01:00:00",
          "outDate": "2019-01-31 23:59:59",
          "total": 10,
          "taxRate": 21,
          "totalWithTax": 12.1,
          "status": "created",
          "statusMsg": null,
          "id": 2,
          "pdf": {
              "fileSize": null,
              "mimeType": null,
              "baseName": null
          },
          "invoiceTemplate": 1,
          "company": 1,
          "numberSequence": null,
          "scheduler": null,
          "currency": "€"
      }
      """

  Scenario: Retrieve created invoice
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "invoices/2"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
      """
      {
          "number": "2",
          "inDate": "2019-01-01 01:00:00",
          "outDate": "2019-01-31 23:59:59",
          "total": 10,
          "taxRate": 21,
          "totalWithTax": 12.1,
          "status": "created",
          "statusMsg": null,
          "id": 2,
          "pdf": {
              "fileSize": null,
              "mimeType": null,
              "baseName": null
          },
          "invoiceTemplate": {
              "name": "Default",
              "description": "Something",
              "template": "Template",
              "templateHeader": "Template header",
              "templateFooter": "Template footer",
              "id": 1
          },
          "company": "~",
          "numberSequence": null,
          "scheduler": null,
          "currency": "€"
      }
      """

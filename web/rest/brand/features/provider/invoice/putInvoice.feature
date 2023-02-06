Feature: Update invoice
  In order to manage invoice
  As a brand admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update an invoice number sequence
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/invoices/1" with body:
      """
      {
          "number": "1",
          "inDate": "2018-01-02 00:00:00",
          "outDate": "2018-01-31 23:59:59",
          "total": 10.0,
          "totalWithTax": 12.1,
          "status": "created",
          "invoiceTemplate": 1,
          "company": 1
      }
      """
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      {
          "number": "1",
          "inDate": "2018-01-02 00:00:00",
          "outDate": "2018-01-31 23:59:59",
          "total": 10,
          "taxRate": 21,
          "totalWithTax": 12.1,
          "status": "created",
          "statusMsg": null,
          "id": 1,
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

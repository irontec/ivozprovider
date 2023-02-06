Feature: Retrieve invoice
  In order to manage invoice
  As a brand admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the invoice  json list
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "invoices"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      [
          {
              "number": "1",
              "inDate": "2018-01-01 01:00:00",
              "outDate": "2018-01-31 23:59:59",
              "total": 0.272,
              "taxRate": 21,
              "totalWithTax": 0.33,
              "status": "processing",
              "id": 1,
              "pdf": {
                  "fileSize": null,
                  "mimeType": null,
                  "baseName": null
              },
              "invoiceTemplate": 1,
              "company": 1,
              "scheduler": null,
              "currency": "€"
          }
      ]
      """

  Scenario: Retrieve certain invoice  json
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "invoices/1"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
      """
      {
          "number": "1",
          "inDate": "2018-01-01 01:00:00",
          "outDate": "2018-01-31 23:59:59",
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
          "invoiceTemplate": "~",
          "company": "~",
          "numberSequence": null,
          "currency": "€"
      }
      """

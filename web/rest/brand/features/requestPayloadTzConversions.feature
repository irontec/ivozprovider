Feature: Input timezone convertion

  @createSchema
  Scenario: Admin can specify date time zone
    Given I add Brand Authorization header
    When I add "Content-Type" header equal to "application/json"
    And I add "Accept" header equal to "application/json"
    And I send a "POST" request to "/invoices?_timezone=America%2FCancun" with body:
    """
      {
          "number": "2",
          "inDate": "2018-12-31 18:00:00",
          "outDate": "2019-01-01 17:59:59",
          "total": 10,
          "taxRate": 21,
          "totalWithTax": 12.1,
          "status": null,
          "statusMsg": null,
          "invoiceTemplate": 1,
          "company": 1,
          "numberSequence": null,
          "scheduler": null
      }
    """
    Then the response status code should be 201
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
       {
          "number": "2",
          "inDate": "2018-12-31 18:00:00",
          "outDate": "2019-01-01 17:59:59",
          "total": 10,
          "taxRate": 21,
          "totalWithTax": 12.1,
          "status": null,
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
          "scheduler": null
      }
    """

  Scenario: Retrieve created item using user time zone (Europe/Madrid)
    Given I add Authorization header for "restrictedBrandAdmin"
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "invoices/2"
    And the JSON should be like:
    """
       {
          "number": "2",
          "inDate": "2019-01-01 00:00:00",
          "outDate": "2019-01-01 23:59:59",
          "total": 10,
          "taxRate": 21,
          "totalWithTax": 12.1,
          "status": null,
          "statusMsg": null,
          "id": 2,
          "pdf": {
              "fileSize": null,
              "mimeType": null,
              "baseName": null
          },
          "invoiceTemplate": "~",
          "company": "~",
          "numberSequence": null,
          "scheduler": null
      }
    """

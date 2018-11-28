Feature: Retrieve fixed costs rel invoices
  In order to manage fixed costs rel invoices
  As an super admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the fixed costs rel invoices json list
    Given I add Brand Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "fixed_costs_rel_invoices"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be like:
    """
      [
          {
              "quantity": 1,
              "id": 1,
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
                  "outDate": "2018-01-31 23:59:59",
                  "total": null,
                  "taxRate": 21,
                  "totalWithTax": null,
                  "status": null,
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
                  "numberSequence": null
              }
          }
      ]
    """

  Scenario: Retrieve certain fixed costs rel invoice json
    Given I add Brand Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "fixed_costs_rel_invoices/1"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be like:
    """
      {
          "quantity": 1,
          "id": 1,
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
              "outDate": "2018-01-31 23:59:59",
              "total": null,
              "taxRate": 21,
              "totalWithTax": null,
              "status": null,
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
              "numberSequence": null
          }
      }
    """

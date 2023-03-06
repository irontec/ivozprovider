Feature: Retrieve invoice scheduler
  In order to manage invoice scheduler
  As a brand admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the invoice scheduler json list
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "invoice_schedulers"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      [
          {
              "name": "SchedulerName",
              "unit": "week",
              "frequency": 1,
              "lastExecution": "2018-12-01 09:00:00",
              "nextExecution": "2018-12-02 09:00:00",
              "id": 1,
              "brand": 1,
              "company": 1
          }
      ]
      """

  Scenario: Retrieve certain invoice scheduler json
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "invoice_schedulers/1"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
      """
      {
          "name": "SchedulerName",
          "unit": "week",
          "frequency": 1,
          "email": "something@domain.net",
          "lastExecution": "2018-12-01 09:00:00",
          "lastExecutionError": "",
          "nextExecution": "2018-12-02 09:00:00",
          "taxRate": 0,
          "id": 1,
          "invoiceTemplate": null,
          "brand": "~",
          "company": "~",
          "numberSequence": {
            "id": 1
          }
      }
      """

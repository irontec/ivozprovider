Feature: Update invoice scheduler
  In order to manage invoice scheduler
  As a brand admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update an invoice scheduler number sequence
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/invoice_schedulers/1" with body:
    """
      {
          "name": "UpdatedSchedulerName",
          "unit": "month",
          "frequency": 1,
          "email": "something-new@domain.net",
          "lastExecution": "2019-12-01 09:00:00",
          "lastExecutionError": "",
          "nextExecution": "2019-12-02 09:00:00",
          "taxRate": 21,
          "invoiceTemplate": null,
          "brand": 1,
          "company": 1,
          "numberSequence": null
      }
    """
    Then the response status code should be 200
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be like:
    """
      {
          "name": "UpdatedSchedulerName",
          "unit": "month",
          "frequency": 1,
          "email": "something-new@domain.net",
          "lastExecution": "2019-12-01 09:00:00",
          "lastExecutionError": "",
          "nextExecution": "2019-12-02 09:00:00",
          "taxRate": 21,
          "id": 1,
          "invoiceTemplate": null,
          "brand": "~",
          "company": "~",
          "numberSequence": null
      }
    """

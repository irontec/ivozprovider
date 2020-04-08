  Feature: Create invoice scheduler
  In order to manage invoice scheduler
  As a brand admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create an invoice scheduler number sequence
    Given I add Brand Authorization header
    When I add "Content-Type" header equal to "application/json"
    And I add "Accept" header equal to "application/json"
    And I send a "POST" request to "/invoice_schedulers" with body:
    """
      {
          "name": "SchedulerName2",
          "unit": "month",
          "frequency": 1,
          "email": "something@domain.net",
          "lastExecution": "2019-12-01 09:00:00",
          "lastExecutionError": "",
          "nextExecution": "2019-12-02 09:00:00",
          "taxRate": 21.0,
          "invoiceTemplate": 1,
          "brand": 1,
          "company": 2,
          "numberSequence": 1
      }
    """
    Then the response status code should be 201
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      {
          "name": "SchedulerName2",
          "unit": "month",
          "frequency": 1,
          "email": "something@domain.net",
          "lastExecution": "2019-12-01 09:00:00",
          "lastExecutionError": "",
          "nextExecution": "2019-12-02 09:00:00",
          "taxRate": 21,
          "id": 2,
          "invoiceTemplate": 1,
          "brand": 1,
          "company": 2,
          "numberSequence": 1
      }
    """

  Scenario: Retrieve created invoice scheduler
    Given I add Brand Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "invoice_schedulers/2"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be like:
    """
      {
          "name": "SchedulerName2",
          "unit": "month",
          "frequency": 1,
          "email": "something@domain.net",
          "lastExecution": "2019-12-01 09:00:00",
          "lastExecutionError": "",
          "nextExecution": "2019-12-02 09:00:00",
          "taxRate": 21,
          "id": 2,
          "invoiceTemplate": {
              "name": "Default",
              "description": "Something",
              "template": "Template",
              "templateHeader": "Template header",
              "templateFooter": "Template footer",
              "id": 1
          },
          "brand": "~",
          "company": "~",
          "numberSequence": {
              "name": "GeneratorName",
              "prefix": "auto",
              "sequenceLength": 4,
              "increment": 1,
              "latestValue": "auto0001",
              "iteration": 1,
              "version": 1,
              "id": 1
          }
      }
    """

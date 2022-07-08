Feature: Create fixed costs rel invoice schedulers
  In order to manage fixed costs rel invoice schedulers
  As a brand admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create a fixed cost rel invoice scheduler
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/fixed_costs_rel_invoice_schedulers" with body:
    """
      {
          "quantity": 1,
          "fixedCost": 2,
          "invoiceScheduler": 1
      }
    """
    Then the response status code should be 201
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be equal to:
    """
      {
          "quantity": 1,
          "type": "static",
          "ddisCountryMatch": null,
          "id": 2,
          "fixedCost": 2,
          "invoiceScheduler": 1,
          "ddisCountry": null
      }
    """

  Scenario: Retrieve created fixed cost rel invoice scheduler
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "fixed_costs_rel_invoice_schedulers/2"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
    """
      {
          "quantity": 1,
          "id": 2,
          "fixedCost": {
              "name": "24x7",
              "description": "Something",
              "cost": 100,
              "id": 2
          },
          "invoiceScheduler": {
              "name": "SchedulerName",
              "unit": "week",
              "frequency": 1,
              "email": "something@domain.net",
              "lastExecution": "2018-12-01 09:00:00",
              "lastExecutionError": "",
              "nextExecution": "2018-12-02 09:00:00",
              "taxRate": null,
              "id": 1,
              "invoiceTemplate": null,
              "brand": 1,
              "company": 1,
              "numberSequence": null
          }
      }
    """

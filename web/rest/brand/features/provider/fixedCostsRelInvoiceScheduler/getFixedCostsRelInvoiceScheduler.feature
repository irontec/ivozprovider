Feature: Retrieve fixed costs rel invoice schedulers
  In order to manage fixed costs rel invoice schedulers
  As a brand admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the fixed costs rel invoice schedulers json list
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "fixed_costs_rel_invoice_schedulers"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      [
          {
              "quantity": 1,
              "type": "static",
              "ddisCountryMatch": null,
              "id": 1,
              "fixedCost": {
                  "name": "Monitoring",
                  "description": "Something",
                  "cost": 1,
                  "id": 1
              },
              "invoiceScheduler": {
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
                  "brand": 1,
                  "company": 1,
                  "numberSequence": 1
              },
              "ddisCountry": null
          }
      ]
      """

  Scenario: Retrieve certain fixed costs rel invoice scheduler json
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "fixed_costs_rel_invoice_schedulers/1"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      {
          "quantity": 1,
          "type": "static",
          "ddisCountryMatch": null,
          "id": 1,
          "fixedCost": {
              "name": "Monitoring",
              "description": "Something",
              "cost": 1,
              "id": 1
          },
          "invoiceScheduler": {
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
              "brand": 1,
              "company": 1,
              "numberSequence": 1
          },
          "ddisCountry": null
      }
      """

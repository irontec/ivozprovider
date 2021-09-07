Feature: Retrieve call CSV scheduler
  In order to manage call CSV scheduler
  As a client admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the call CSV scheduler json list
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "call_csv_schedulers"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
      [
          {
              "name": "SchedulerName",
              "unit": "day",
              "frequency": 1,
              "callDirection": "outbound",
              "email": "something@domain.net",
              "lastExecution": "2018-12-01 09:00:00",
              "lastExecutionError": "",
              "nextExecution": "2018-12-02 09:00:00",
              "id": 2
          }
      ]
    """

  Scenario: Retrieve certain call CSV scheduler json
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "call_csv_schedulers/2"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
    """
       {
          "name": "SchedulerName",
          "unit": "day",
          "frequency": 1,
          "callDirection": "outbound",
          "email": "something@domain.net",
          "lastExecution": "2018-12-01 09:00:00",
          "lastExecutionError": "",
          "nextExecution": "2018-12-02 09:00:00",
          "id": 2,
          "callCsvNotificationTemplate": null,
          "ddi": null,
          "retailAccount": null,
          "residentialDevice": null,
          "user": null,
          "fax": null,
          "friend": null
      }
    """

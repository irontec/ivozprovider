Feature: Update call CSV scheduler
  In order to manage call CSV scheduler
  As a client admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update a call CSV scheduler
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/call_csv_schedulers/2   " with body:
    """
       {
          "name": "updated name",
          "unit": "week",
          "frequency": 1,
          "callDirection": "outbound",
          "email": "something@domain.net",
          "nextExecution": "2019-12-02 09:00:00"
      }
    """
    Then the response status code should be 200
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be like:
    """
      {
          "name": "updated name",
          "unit": "week",
          "frequency": 1,
          "callDirection": "outbound",
          "email": "something@domain.net",
          "lastExecution": "2018-12-01 09:00:00",
          "lastExecutionError": "",
          "nextExecution": "2019-12-02 09:00:00",
          "id": 2,
          "callCsvNotificationTemplate": null
      }
    """

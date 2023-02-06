Feature: Update call CSV scheduler
  In order to manage call CSV scheduler
  As a brand admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update a call CSV scheduler
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/call_csv_schedulers/1" with body:
      """
       {
          "name": "updated name",
          "unit": "week",
          "frequency": 1,
          "callDirection": "outbound",
          "email": "something@domain.net",
          "nextExecution": "2019-12-02 09:00:00",
          "callCsvNotificationTemplate": 1,
          "ddi": null,
          "carrier": 1,
          "retailAccount": null,
          "residentialDevice": null,
          "residentialDevice": null,
          "user": null,
          "fax": null,
          "friend": null,
          "ddiProvider": null
      }
      """
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
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
          "id": 1,
          "company": null,
          "callCsvNotificationTemplate": 1,
          "ddi": null,
          "carrier": 1,
          "retailAccount": null,
          "residentialDevice": null,
          "user": null,
          "fax": null,
          "friend": null,
          "ddiProvider": null
      }
      """

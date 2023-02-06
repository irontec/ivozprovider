Feature: Retrieve call CSV report
  In order to manage call CSV report
  As a client admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the call CSV report json list
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "call_csv_reports"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      [
          {
              "sentTo": "",
              "inDate": "2019-05-31 02:00:00",
              "outDate": "2019-06-01 01:59:59",
              "createdOn": "2019-06-01 07:59:59",
              "id": 2,
              "csv": {
                  "fileSize": null,
                  "mimeType": null,
                  "baseName": null
              },
              "callCsvScheduler": 2
          }
      ]
      """

  Scenario: Retrieve certain call CSV report json
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "call_csv_reports/2"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
      """
       {
          "sentTo": "",
          "inDate": "2019-05-31 02:00:00",
          "outDate": "2019-06-01 01:59:59",
          "createdOn": "2019-06-01 07:59:59",
          "id": 2,
          "csv": {
              "fileSize": null,
              "mimeType": null,
              "baseName": null
          },
          "callCsvScheduler": {
              "name": "SchedulerName",
              "unit": "day",
              "frequency": 1,
              "callDirection": "outbound",
              "email": "something@domain.net",
              "lastExecution": "2018-12-01 09:00:00",
              "lastExecutionError": "",
              "nextExecution": "2018-12-02 09:00:00",
              "id": 2,
              "callCsvNotificationTemplate": null
          }
      }
      """

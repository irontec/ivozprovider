Feature: Update call CSV reports
  In order to manage call CSV reports
  As a brand admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update call CSV report
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/call_csv_reports/1" with body:
      """
      {
          "inDate": "2019-06-01 02:00:00",
          "outDate": "2019-06-02 01:59:59",
          "createdOn": "2019-06-03 07:59:59"
      }
      """
     Then the response status code should be 405

Feature: Create call csv reports
  In order to manage call CSV reports
  As a brand admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create a call CSV report
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/call_csv_reports" with body:
      """
      {
          "sentTo": "",
          "inDate": "2019-06-01 02:00:00",
          "outDate": "2019-06-02 01:59:59",
          "createdOn": "2019-06-03 07:59:59"
      }
      """
     Then the response status code should be 405

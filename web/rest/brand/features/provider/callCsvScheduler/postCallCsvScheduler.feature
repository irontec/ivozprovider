Feature: Create call CSV scheduler
  In order to manage brand services
  As an super admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create a call CSV scheduler
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/call_csv_schedulers" with body:
    """
      {
          "name": "some name",
          "unit": "day",
          "frequency": 1,
          "callDirection": "outbound",
          "email": "something@domain.net",
          "nextExecution": "2018-12-02 09:00:00",
          "brand": 1,
          "callCsvNotificationTemplate": 1
      }
    """
    Then the response status code should be 201
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be equal to:
    """
      {
          "name": "some name",
          "unit": "day",
          "frequency": 1,
          "callDirection": "outbound",
          "email": "something@domain.net",
          "lastExecution": null,
          "lastExecutionError": null,
          "nextExecution": "2018-12-02 09:00:00",
          "id": 3,
          "brand": 1,
          "company": null,
          "callCsvNotificationTemplate": 1
      }
    """

  Scenario: Retrieve created call CSV scheduler
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "call_csv_schedulers/3"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
    """
      {
          "name": "some name",
          "unit": "day",
          "frequency": 1,
          "callDirection": "outbound",
          "email": "something@domain.net",
          "lastExecution": null,
          "lastExecutionError": null,
          "nextExecution": "2018-12-02 09:00:00",
          "id": 3,
          "brand": "~",
          "company": null,
          "callCsvNotificationTemplate": {
              "name": "Voicemail notification",
              "type": "voicemail",
              "id": 1,
              "brand": 1
          }
      }
    """

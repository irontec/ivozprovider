Feature: Create call CSV scheduler
  In order to manage call CSV scheduler
  As an super admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create a call CSV scheduler
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/call_csv_schedulers" with body:
    """
      {
          "name": "new scheduler name",
          "unit": "day",
          "frequency": 2,
          "callDirection": "outbound",
          "email": "something@domain.net",
          "nextExecution": "2018-12-02 09:00:00",
          "company": 1,
          "callCsvNotificationTemplate": null
      }
    """
    Then the response status code should be 201
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be equal to:
    """
      {
          "name": "new scheduler name",
          "unit": "day",
          "frequency": 2,
          "callDirection": "outbound",
          "email": "something@domain.net",
          "lastExecution": null,
          "lastExecutionError": null,
          "nextExecution": "2018-12-02 09:00:00",
          "id": 3,
          "company": 1,
          "callCsvNotificationTemplate": null
      }
    """

  Scenario: Retrieve created call CSV scheduler
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "call_csv_schedulers/3"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
    """
      {
          "name": "new scheduler name",
          "unit": "day",
          "frequency": 2,
          "callDirection": "outbound",
          "email": "something@domain.net",
          "lastExecution": null,
          "lastExecutionError": null,
          "nextExecution": "2018-12-02 09:00:00",
          "id": 3,
          "company": {
              "type": "vpbx",
              "name": "DemoCompany",
              "domainUsers": "127.0.0.1",
              "nif": "12345678A",
              "onDemandRecordCode": "",
              "balance": 1.2,
              "id": 1,
              "language": 1,
              "defaultTimezone": 145,
              "country": 68,
              "transformationRuleSet": 1,
              "outgoingDdi": null,
              "outgoingDdiRule": null
          },
          "callCsvNotificationTemplate": null
      }
    """

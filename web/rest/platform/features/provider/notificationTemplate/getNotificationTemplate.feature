Feature: Retrieve notification templates
  In order to manage notification templates
  As a super admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the notification templates json list
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "notification_templates"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      [
          {
              "name": "CallCsv notification",
              "type": "callCsv",
              "id": 2
          },
          {
              "name": "Max daily usage notification",
              "type": "maxDailyUsage",
              "id": 3
          },
          {
              "name": "Invoice notification",
              "type": "invoice",
              "id": 4
          }
      ]
      """

  Scenario: Retrieve certain notification templates json
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "notification_templates/2"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
      """
      {
          "name": "CallCsv notification",
          "type": "callCsv",
          "id": 2,
          "brand": null
      }
      """

Feature: Retrieve notification template contents
  In order to manage notification template contents
  As a super admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the notification template contents json list
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "notification_template_contents"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      [
          {
              "fromName": "IvozProvider Notification",
              "fromAddress": "no-reply@ivozprovider.com",
              "id": 2,
              "language": 1
          },
          {
              "fromName": "IvozProvider Notification",
              "fromAddress": "no-reply@ivozprovider.com",
              "id": 3,
              "language": 1
          }
      ]
      """

  Scenario: Retrieve certain notification template contents json
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "notification_template_contents/2"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
      """
      {
          "fromName": "IvozProvider Notification",
          "fromAddress": "no-reply@ivozprovider.com",
          "subject": "test subject",
          "body": "test body",
          "bodyType": "text/plain",
          "id": 2,
          "notificationTemplate": {
              "name": "CallCsv notification",
              "type": "callCsv",
              "id": 2,
              "brand": null
          },
          "language": "~"
      }
      """

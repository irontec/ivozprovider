Feature: Update notification template contents
  In order to manage notification template contents
  As a brand admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update an notification template content
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/notification_template_contents/1" with body:
      """
      {
          "language": 2,
          "notificationTemplate": 1,
          "subject": "New Test subject",
          "body": "New Test body"
      }
      """
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      {
          "fromName": "IvozProvider Notification",
          "fromAddress": "no-reply@ivozprovider.com",
          "subject": "New Test subject",
          "body": "New Test body",
          "bodyType": "text\/plain",
          "id": 1,
          "notificationTemplate": 1,
          "language": 2
      }
      """

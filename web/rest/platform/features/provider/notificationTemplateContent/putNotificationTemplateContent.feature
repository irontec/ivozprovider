Feature: Update notification template contents
  In order to manage notification template contents
  As a super admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update an notification template content
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/notification_template_contents/2" with body:
      """
      {
          "fromName": "IvozProvider Notification Update",
          "fromAddress": "no-reply@ivozprovider.com",
          "language": 1
      }
      """
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      {
          "fromName": "IvozProvider Notification Update",
          "fromAddress": "no-reply@ivozprovider.com",
          "subject": "test subject",
          "body": "test body",
          "bodyType": "text/plain",
          "id": 2,
          "notificationTemplate": 2,
          "language": 1
      }
      """

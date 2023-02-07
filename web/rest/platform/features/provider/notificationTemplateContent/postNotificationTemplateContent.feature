Feature: Create notification templates content
  In order to manage notification templates
  As a super admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Can't create a notification template content
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/notification_template_contents" with body:
      """
      {
        "fromName": "IvozProvider Notification",
        "fromAddress": "no-reply@ivozprovider.com",
        "language": 1
      }
      """
     Then the response status code should be 405

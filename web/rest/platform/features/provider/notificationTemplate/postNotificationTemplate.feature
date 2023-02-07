Feature: Create notification templates
  In order to manage notification templates
  As a super admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Can't create a notification template
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/notification_templates" with body:
      """
      {
          "name": "New fax notification",
          "type": "fax"
      }
      """
     Then the response status code should be 405

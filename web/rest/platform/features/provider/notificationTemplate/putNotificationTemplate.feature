Feature: Update notification templates
  In order to manage notification templates
  As a super admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Can't update a notification template
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/notification_templates/2" with body:
      """
      {
          "name": "New fax notification",
          "type": "voicemail"
      }
      """
     Then the response status code should be 405

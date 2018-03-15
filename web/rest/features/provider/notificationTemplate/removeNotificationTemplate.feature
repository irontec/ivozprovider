Feature: Manage notification templates
  In order to manage notification templates
  As an super admin
  I need to be able to delete them through the API.

  @createSchema
  Scenario: Remove a notification templates
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "DELETE" request to "/notification_templates/1"
     Then the response status code should be 204
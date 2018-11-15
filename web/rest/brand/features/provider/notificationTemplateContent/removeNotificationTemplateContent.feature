Feature: Manage notification template contents
  In order to manage notification template contents
  As an super admin
  I need to be able to delete them through the API.

  @createSchema
  Scenario: Remove a notification template contents
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "DELETE" request to "/notification_template_contents/1"
     Then the response status code should be 204
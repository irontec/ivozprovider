Feature: Manage notification template contents
  In order to manage notification template contents
  As a super admin
  I need to be able to delete them through the API.

  @createSchema
  Scenario: Can't remove a notification template contents
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "DELETE" request to "/notification_template_contents/1"
     Then the response status code should be 405

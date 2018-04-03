Feature: Manage balance notifications
  In order to manage balance notifications
  As an super admin
  I need to be able to delete them through the API.

  @createSchema
  Scenario: Remove a balance notifications
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "DELETE" request to "/balance_notifications/1"
     Then the response status code should be 204
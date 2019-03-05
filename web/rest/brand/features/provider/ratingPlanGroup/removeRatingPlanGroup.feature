Feature: Manage rating plan group
  In order to manage rating plan group
  As an super admin
  I need to be able to delete them through the API.

  @createSchema
  Scenario: Remove a rating plan group
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "DELETE" request to "/rating_plan_groups/1"
     Then the response status code should be 204

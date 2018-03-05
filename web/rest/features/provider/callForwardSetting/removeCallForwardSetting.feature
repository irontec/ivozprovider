Feature: Remove application servers
  In order to manage call forward settings
  As an super admin
  I need to be able to delete them through the API.

  @createSchema
  Scenario: Remove a call forward setting
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "DELETE" request to "/call_forward_settings/1"
     Then the response status code should be 204
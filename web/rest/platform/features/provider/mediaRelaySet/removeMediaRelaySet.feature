Feature: Manage media relay sets
  In order to manage media relay sets
  As an super admin
  I need to be able to delete them through the API.

  @createSchema
  Scenario: Remove a media relay sets
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "DELETE" request to "/media_relay_sets/1"
     Then the response status code should be 204
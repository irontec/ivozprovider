Feature: Manage recordings
  In order to manage recordings
  As an super admin
  I need to be able to delete them through the API.

  @createSchema
  Scenario: Remove a recording
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "DELETE" request to "/recordings/1"
     Then the response status code should be 204

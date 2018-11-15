Feature: Manage ivr excluded extensions
  In order to manage ivr excluded extensions
  As an super admin
  I need to be able to delete them through the API.

  @createSchema
  Scenario: Remove a ivr excluded extension
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "DELETE" request to "/ivr_excluded_extensions/1"
     Then the response status code should be 204

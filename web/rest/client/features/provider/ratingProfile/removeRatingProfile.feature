Feature: Manage rating profiles
  In order to manage rating profiles
  As a client admin
  I need to be able to delete them through the API.

  @createSchema
  Scenario: Remove a rating profile
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "DELETE" request to "/rating_profiles/1"
     Then the response status code should be 405

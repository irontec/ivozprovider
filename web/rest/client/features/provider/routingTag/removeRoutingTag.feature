Feature: Manage routing tags
  In order to manage routing tags
  As a company admin
  I need to be able to delete them through the API.

  @createSchema
  Scenario: Remove a routing pattern
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "DELETE" request to "/routing_tags/1"
     Then the response status code should be 405

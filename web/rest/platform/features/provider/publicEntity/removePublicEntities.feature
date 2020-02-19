Feature: Manage public entities
  In order to manage public entities
  as a super admin
  I need to be able to delete them through the API.

  @createSchema
  Scenario: Remove a administrator
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "DELETE" request to "/public_entities/4"
     Then the response status code should be 405

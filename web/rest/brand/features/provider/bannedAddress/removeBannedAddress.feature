Feature: Manage banned addresses
  In order to manage banned addresses
  as a super admin
  I need to be able to delete them through the API.

  @createSchema
  Scenario: Remove a banned address
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "DELETE" request to "/banned_addresses/2"
     Then the response status code should be 405

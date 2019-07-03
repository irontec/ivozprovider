Feature: Remove retail account
  In order to manage retail accounts
  As a brand admin
  I need to be able to delete them through the API.

  @createSchema
  Scenario: Remove a retail account
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "DELETE" request to "/retail_accounts/1"
     Then the response status code should be 204

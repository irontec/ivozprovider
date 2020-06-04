Feature: Manage retail accounts
  In order to manage retail accounts
  As a client admin
  I need to be able to delete them through the API.

  @createSchema
  Scenario: Remove a retail account
    Given I add Retail Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "DELETE" request to "/retail_accounts/1"
     Then the response status code should be 405

Feature: Manage destination rate
  In order to manage destination rate
  As an super admin
  I need to be able to delete them through the API.

  @createSchema
  Scenario: Remove a destination rate
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "DELETE" request to "/destination_rates/1"
     Then the response status code should be 204

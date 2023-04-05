Feature: Manage balance movements
  In order to manage balance movements
  As a brand admin
  I need to be able to delete them through the API.

  @createSchema
  Scenario: Cannot remove balance movements
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "DELETE" request to "/balance_movements/1"
     Then the response status code should be 405

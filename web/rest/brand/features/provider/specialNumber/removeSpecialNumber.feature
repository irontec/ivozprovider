Feature: Manage special numbers
  In order to manage special numbers
  as a brand admin
  I need to be able to delete them through the API.

  @createSchema
  Scenario: Remove a special numbers
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "DELETE" request to "/special_numbers/2"
     Then the response status code should be 204

  Scenario: Cannot remove a global special numbers
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "DELETE" request to "/special_numbers/1"
     Then the response status code should be 403

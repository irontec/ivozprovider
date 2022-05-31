Feature: Manage currencies
  In order to manage currencies
  as a super admin
  I need to be able to delete them through the API.

  @createSchema
  Scenario: Can't remove a currency
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "DELETE" request to "/currencies/1"
     Then the response status code should be 404

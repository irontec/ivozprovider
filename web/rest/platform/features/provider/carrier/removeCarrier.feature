Feature: Manage carriers
  In order to manage carriers
  as a super admin
  I need to be able to delete them through the API.

  @createSchema
  Scenario: Remove a carrier
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "DELETE" request to "/carriers/1"
     Then the response status code should be 404

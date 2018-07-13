Feature: Manage carrier servers
  In order to manage carrier servers
  As an super admin
  I need to be able to delete them through the API.

  @createSchema
  Scenario: Remove a carrier server
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "DELETE" request to "/carrier_servers/1"
     Then the response status code should be 204

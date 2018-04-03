Feature: Manage peer servers
  In order to manage peer servers
  As an super admin
  I need to be able to delete them through the API.

  @createSchema
  Scenario: Remove a peer server
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "DELETE" request to "/peer_servers/1"
     Then the response status code should be 204

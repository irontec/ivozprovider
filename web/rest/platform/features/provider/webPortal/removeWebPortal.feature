Feature: Manage web portals
  In order to manage web portals
  as a super admin
  I need to be able to delete them through the API.

  @createSchema
  Scenario: Remove a web portal
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "DELETE" request to "/web_portals/1"
     Then the response status code should be 204

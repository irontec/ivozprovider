Feature: Manage proxy trunks
  In order to manage proxy trunks
  As a super admin
  I need to be able to delete them through the API.

  @createSchema
  Scenario: Can't remove a proxy trunk with id equal to one
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "DELETE" request to "/proxy_trunks/1"
     Then the response status code should be 403

  @createSchema
  Scenario: Can remove a proxy trunk with id different to one
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "DELETE" request to "/proxy_trunks/3"
     Then the response status code should be 204

Feature: Manage outgoing ddi rules
  In order to manage outgoing ddi rules
  As an super admin
  I need to be able to delete them through the API.

  @createSchema
  Scenario: Remove a outgoing ddi rule
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "DELETE" request to "/outgoing_ddi_rules/1"
     Then the response status code should be 204

Feature: Update outgoing ddi rules
  In order to manage outgoing ddi rules
  As a brand admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update an outgoing ddi rules
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/outgoing_ddi_rules/1" with body:
      """
      {
          "name": "updatedRule",
      }
      """
     Then the response status code should be 405

Feature: Update outgoing ddi rules patterns
  In order to manage outgoing ddi rules patterns
  As a client admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update an outgoing ddi rules patterns
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/outgoing_ddi_rules_patterns/1" with body:
      """
      {
          "action": "force",
          "priority": 10,
          "outgoingDdiRule": 1,
          "matchList": 2,
          "forcedDdi": 1,
          "type": "prefix",
          "prefix": "12*"
      }
      """
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      {
          "type": "prefix",
          "prefix": "12*",
          "action": "force",
          "priority": 10,
          "id": 1,
          "outgoingDdiRule": 1,
          "matchList": null,
          "forcedDdi": 1
      }
      """

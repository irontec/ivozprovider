Feature: Update outgoing ddi rules patterns
  In order to manage outgoing ddi rules patterns
  As an super admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update an outgoing ddi rules patterns
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/outgoing_ddi_rules_patterns/1" with body:
    """
      {
          "action": "force",
          "priority": 10,
          "id": 1,
          "outgoingDdiRule": 1,
          "matchList": 2,
          "forcedDdi": 1
      }
    """
    Then the response status code should be 200
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be like:
    """
      {
          "action": "force",
          "priority": 10,
          "id": 1,
          "outgoingDdiRule": {
              "name": "testRule",
              "defaultAction": "keep",
              "id": 1,
              "company": 1,
              "forcedDdi": null
          },
          "matchList": {
              "name": "testMatchlist2",
              "id": 2,
              "brand": null,
              "company": 1
          },
          "forcedDdi": "~"
      }
    """

Feature: Retrieve outgoing ddi rules patterns
  In order to manage outgoing ddi rules patterns
  As an super admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the outgoing ddi rules patterns json list
    Given I add Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "outgoing_ddi_rules_patterns"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      [
          {
              "action": "keep",
              "priority": 1,
              "id": 1,
              "outgoingDdiRule": {
                  "name": "testRule",
                  "defaultAction": "keep",
                  "id": 1,
                  "company": 1,
                  "forcedDdi": null
              },
              "matchList": {
                  "name": "testMatchlist",
                  "id": 1,
                  "brand": null,
                  "company": 1
              },
              "forcedDdi": null
          }
      ]
    """

  Scenario: Retrieve certain outgoing ddi rules pattern json
    Given I add Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "outgoing_ddi_rules_patterns/1"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
       {
          "action": "keep",
          "priority": 1,
          "id": 1,
          "outgoingDdiRule": {
              "name": "testRule",
              "defaultAction": "keep",
              "id": 1,
              "company": 1,
              "forcedDdi": null
          },
          "matchList": {
              "name": "testMatchlist",
              "id": 1,
              "brand": null,
              "company": 1
          },
          "forcedDdi": null
      }
    """

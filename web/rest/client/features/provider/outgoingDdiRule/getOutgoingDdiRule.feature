Feature: Retrieve outgoing ddi rules
  In order to manage outgoing ddi rules
  As an super admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the outgoing ddi rules json list
    Given I add Company Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "outgoing_ddi_rules"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      [
          {
              "name": "testRule",
              "defaultAction": "keep",
              "id": 1
          }
      ]
    """

  Scenario: Retrieve certain outgoing ddi rule json
    Given I add Company Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "outgoing_ddi_rules/1"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be like:
    """
      {
          "name": "testRule",
          "defaultAction": "keep",
          "id": 1,
          "company": "~",
          "forcedDdi": null
      }
    """

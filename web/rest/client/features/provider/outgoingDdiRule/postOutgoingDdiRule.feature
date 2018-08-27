Feature: Create outgoing ddi rules
  In order to manage outgoing ddi rules
  As an super admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create an outgoing ddi rule
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/outgoing_ddi_rules" with body:
    """
      {
          "name": "newRule",
          "defaultAction": "keep",
          "id": 1,
          "company": 2,
          "forcedDdi": null
      }
    """
    Then the response status code should be 201
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be equal to:
    """
      {
          "name": "newRule",
          "defaultAction": "keep",
          "id": 2
      }
    """

  Scenario: Retrieve created outgoing ddi rule
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "outgoing_ddi_rules/2"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
    """
      {
          "name": "newRule",
          "defaultAction": "keep",
          "id": 2,
          "company": "~",
          "forcedDdi": null
      }
    """

Feature: Create outgoing ddi rules
  In order to manage outgoing ddi rules
  As a brand admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create an outgoing ddi rule
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/outgoing_ddi_rules" with body:
    """
          {
              "name": "testRule",
              "defaultAction": "keep",
              "id": 1,
              "forcedDdi": null
          }
    """
    Then the response status code should be 405

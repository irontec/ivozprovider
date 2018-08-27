Feature: Retrieve pick up groups
  In order to manage pick up groups
  As an super admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the pick up groups json list
    Given I add Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "pick_up_groups"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      [
        {
            "name": "pick up group",
            "id": 1
        }
      ]
    """

  Scenario: Retrieve certain pick up group json
    Given I add Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "pick_up_groups/1"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be like:
    """
      {
          "name": "pick up group",
          "id": 1,
          "company": "~"
      }
    """

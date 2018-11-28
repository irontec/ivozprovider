Feature: Create pick up groups
  In order to manage pick up groups
  As an super admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create a pick up group
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/pick_up_groups" with body:
    """
      {
          "name": "new pick up group",
          "company": 2
      }
    """
    Then the response status code should be 201
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be equal to:
    """
      {
          "name": "new pick up group",
          "id": 2
      }
    """

  Scenario: Retrieve created pick up group
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "/pick_up_groups/2"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
    """
      {
          "name": "new pick up group",
          "id": 2,
          "company": "~"
      }
    """

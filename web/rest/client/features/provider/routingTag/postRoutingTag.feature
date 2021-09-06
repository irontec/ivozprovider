Feature: Create routing tags
  In order to manage routing tags
  As a company admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create a routing tags
    Given I add Company Authorization header
    When I add "Content-Type" header equal to "application/json"
    And I add "Accept" header equal to "application/json"
    And I send a "POST" request to "/routing_tags" with body:
    """
      {
          "name": "Mine",
          "tag": "00#",
          "id": 1
      }
    """
    Then the response status code should be 405
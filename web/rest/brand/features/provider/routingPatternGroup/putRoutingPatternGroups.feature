Feature: Update routing pattern groups
  In order to manage routing pattern groups
  As an super admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update a routing pattern group
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/routing_pattern_groups/1" with body:
    """
      {
          "name": "Centreal Europe",
          "description": "Description",
          "brand": 1
      }
    """
    Then the response status code should be 200
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be like:
    """
      {
          "name": "Centreal Europe",
          "description": "Description",
          "id": 1,
          "brand": "~"
      }
    """

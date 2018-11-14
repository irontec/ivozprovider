Feature: Update fixed costs
  In order to manage fixed costs
  As an super admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update an fixed cost
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/fixed_costs/1" with body:
    """
      {
          "name": "Monitoring upgraded",
          "description": "Something else",
          "cost": 1.2,
          "brand": 1
      }
    """
    Then the response status code should be 200
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be like:
    """
      {
          "name": "Monitoring upgraded",
          "description": "Something else",
          "cost": 1.2,
          "id": 1,
          "brand": "~"
      }
    """

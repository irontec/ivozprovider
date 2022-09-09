Feature: Update match list patterns
  In order to manage match list patterns
  As a brand admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update a match list pattern
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/match_list_patterns/2" with body:
    """
      {
          "description": "updated brand test",
          "type": "number",
          "regexp": null,
          "numbervalue": "956002059",
          "matchList": 3,
          "numberCountry": 70
      }
    """
    Then the response status code should be 200
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be like:
    """
      {
          "description": "updated brand test",
          "type": "number",
          "regexp": null,
          "numbervalue": "956002059",
          "id": 2,
          "matchList": 3,
          "numberCountry": 70
      }
    """

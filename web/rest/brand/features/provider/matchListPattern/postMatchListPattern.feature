Feature: Create match list patterns
  In order to manage match list patterns
  As a brand admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create a match list pattern
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/match_list_patterns" with body:
      """
      {
          "description": "new brand test",
          "type": "number",
          "regexp": null,
          "numbervalue": "946002059",
          "matchList": 3,
          "numberCountry": 68
      }
      """
     Then the response status code should be 201
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      {
          "description": "new brand test",
          "type": "number",
          "regexp": null,
          "numbervalue": "946002059",
          "id": 3,
          "matchList": 3,
          "numberCountry": 68
      }
      """

  Scenario: Retrieve created match list pattern
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "/match_list_patterns/3"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
      """
      {
          "description": "new brand test",
          "type": "number",
          "regexp": null,
          "numbervalue": "946002059",
          "id": 3,
          "matchList": "~",
          "numberCountry": "~"
      }
      """

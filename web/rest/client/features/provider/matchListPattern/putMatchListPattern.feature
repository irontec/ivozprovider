Feature: Update match list patterns
  In order to manage match list patterns
  As a client admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update a match list pattern
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/match_list_patterns/1" with body:
      """
      {
          "description": "test desc updated",
          "type": "number",
          "regexp": null,
          "numbervalue": "946002052",
          "matchList": 1,
          "numberCountry": 77
      }
      """
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      {
           "description": "test desc updated",
           "type": "number",
           "regexp": null,
           "numbervalue": "946002052",
           "id": 1,
           "matchList": 1,
           "numberCountry": 77
       }
      """

  Scenario: Cannot update generic match list pattern
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/match_list_patterns/2" with body:
      """
      {
          "description": "Updated Match List Pattern"
      }
      """
     Then the response status code should be 403

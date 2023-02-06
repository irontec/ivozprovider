Feature: Update match lists
  In order to manage match lists
  As a client admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update a match list
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/match_lists/1" with body:
      """
      {
          "name": "updatedMatchlist"
      }
      """
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
      """
      {
           "name": "updatedMatchlist",
           "id": 1
       }
      """

  Scenario: Cannot update brand match list
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/match_lists/3" with body:
      """
      {
          "name": "updatedMatchlist"
      }
      """
     Then the response status code should be 403

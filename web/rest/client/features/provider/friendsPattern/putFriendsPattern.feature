Feature: Update friends patterns
  In order to manage friends patterns
  As a client admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update a friend pattern
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/friends_patterns/1" with body:
      """
      {
          "name": "Spain modified",
          "regExp": "+34[6|7|9]",
          "id": 1,
          "friend": 1
      }
      """
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      {
          "name": "Spain modified",
          "regExp": "+34[6|7|9]",
          "id": 1,
          "friend": 1
      }
      """

Feature: Update queue members
  In order to manage queue members
  As a client admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update a queue member
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/queue_members/1" with body:
      """
      {
          "penalty": 2,
          "queue": 1,
          "user": 2
      }
      """
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      {
          "penalty": 2,
          "id": 1,
          "queue": 1,
          "user": 2
      }
      """

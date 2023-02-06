Feature: Update pick up groups
  In order to manage pick up groups
  As a client admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update a pick up group
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/pick_up_groups/1" with body:
      """
      {
          "name": "updated pick up group",
          "userIds": [
            2
          ]
      }
      """
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
      """
      {
          "name": "updated pick up group",
          "id": 1,
          "userIds": [
            2
          ]
      }
      """

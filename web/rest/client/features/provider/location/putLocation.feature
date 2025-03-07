Feature: Update locations
  In order to manage locations
  As a client admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update a locations
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/locations/1" with body:
      """
      {
          "name": "updatesLocation"
      }
      """
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
      """
      {
          "name": "updatesLocation",
          "description": "Test Location description",
          "id": 1
      }
      """

  @createSchema
  Scenario: Update a location
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/locations/1" with body:
      """
      {
        "userIds": [
          1,
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
          "name": "testLocation",
          "description": "Test Location description",
          "id": 1,
          "userIds": [
            1,
            2
          ]
      }
      """

  Scenario: Retrieve certain user json
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "users/3"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
      """
      {
        "location": null
      }
      """

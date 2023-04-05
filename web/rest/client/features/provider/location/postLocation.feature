Feature: Create locations
  In order to manage locations
  As a client admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create a location
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/locations" with body:
      """
      {
          "name": "newLocation",
          "description": "New location from rest API"
      }
      """
     Then the response status code should be 201
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      {
          "name": "newLocation",
          "description": "New location from rest API",
          "id": 2
      }
      """

  Scenario: Retrieve created location
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "locations/2"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
      """
      {
          "name": "newLocation",
          "description": "New location from rest API",
          "id": 2
      }
      """

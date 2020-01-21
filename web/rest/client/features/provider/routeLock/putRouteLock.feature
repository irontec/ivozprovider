Feature: Update route locks
  In order to manage route locks
  As a client admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update a route lock
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/route_locks/1" with body:
    """
            {
          "name": "Updated name",
          "description": "Updated description",
          "open": false
      }
    """
    Then the response status code should be 200
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be like:
    """
      {
          "name": "Updated name",
          "description": "Updated description",
          "open": false,
          "id": 1
      }
    """

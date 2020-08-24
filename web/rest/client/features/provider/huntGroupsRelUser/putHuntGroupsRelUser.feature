Feature: Update hunt groups rel users
  In order to manage hunt groups rel users
  As a client admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update a hunt group rel user
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/hunt_groups_rel_users/1" with body:
    """
      {
          "timeoutTime": 2,
          "priority": 10,
          "routeType": "user",
          "id": 1,
          "huntGroup": 1,
          "user": 1
      }
    """
    Then the response status code should be 200
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be equal to:
    """
     {
          "timeoutTime": 2,
          "priority": 10,
          "routeType": "user",
          "numberValue": null,
          "id": 1,
          "huntGroup": 1,
          "user": 1,
          "numberCountry": null
      }
    """

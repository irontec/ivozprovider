Feature: Create conditional routes conditions route lock
  In order to manage conditional routes conditions route lock
  As a client admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create an conditional routes conditions rel schedule
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/conditional_routes_conditions_rel_route_locks" with body:
    """
      {
          "condition": 1,
          "routeLock": 2
      }
    """
    Then the response status code should be 201
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be equal to:
    """
      {
          "id": 2,
          "condition": {
              "priority": 1,
              "routeType": null,
              "numberValue": null,
              "friendValue": null,
              "id": 1,
              "conditionalRoute": 1,
              "ivr": null,
              "huntGroup": null,
              "voicemail": null,
              "user": null,
              "queue": null,
              "locution": null,
              "conferenceRoom": null,
              "extension": null,
              "numberCountry": null
          },
          "routeLock": {
              "name": "Test Lock",
              "description": "Test Lock",
              "open": true,
              "id": 2,
              "closeExtension": "",
              "openExtension": "",
              "toggleExtension": ""
          }
      }
    """

  Scenario: Retrieve created conditional routes conditions rel schedule
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "conditional_routes_conditions_rel_route_locks/2"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
      {
          "id": 2,
          "condition": {
              "priority": 1,
              "routeType": null,
              "numberValue": null,
              "friendValue": null,
              "id": 1,
              "conditionalRoute": 1,
              "ivr": null,
              "huntGroup": null,
              "voicemail": null,
              "user": null,
              "queue": null,
              "locution": null,
              "conferenceRoom": null,
              "extension": null,
              "numberCountry": null
          },
          "routeLock": {
              "name": "Test Lock",
              "description": "Test Lock",
              "open": true,
              "id": 2,
              "closeExtension": "",
              "openExtension": "",
              "toggleExtension": ""
          }
      }
    """

Feature: Retrieve conditional routes conditions route lock
  In order to manage conditional routes conditions route lock
  As a client admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the conditional routes conditions route lock json list
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "conditional_routes_conditions_rel_route_locks"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
      [
          {
              "id": 1,
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
                  "name": "Lock name",
                  "description": "Lock description",
                  "open": true,
                  "id": 1,
                  "closeExtension": "",
                  "openExtension": "",
                  "toggleExtension": ""
              }
          }
      ]
    """

  Scenario: Retrieve certain conditional routes conditions rel schedule json
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "conditional_routes_conditions_rel_route_locks/1"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
      {
          "id": 1,
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
              "name": "Lock name",
              "description": "Lock description",
              "open": true,
              "id": 1,
              "closeExtension": "",
              "openExtension": "",
              "toggleExtension": ""
          }
      }
    """

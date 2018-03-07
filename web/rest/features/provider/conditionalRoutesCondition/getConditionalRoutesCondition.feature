Feature: Retrieve conditional routes conditions
  In order to manage conditional routes conditions
  As an super admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the conditional routes conditions json list
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "conditional_routes_conditions"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
      [
          {
              "priority": 1,
              "routeType": null,
              "id": 1
          }
      ]
    """

  Scenario: Retrieve certain conditional routes condition json
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "conditional_routes_conditions/1"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
      {
          "priority": 1,
          "routeType": null,
          "numberValue": null,
          "friendValue": null,
          "id": 1,
          "conditionalRoute": {
              "name": "testConditional",
              "routetype": "user",
              "numbervalue": null,
              "friendvalue": null,
              "id": 1,
              "company": 1,
              "ivr": null,
              "huntGroup": null,
              "voicemailUser": null,
              "user": 1,
              "queue": null,
              "locution": null,
              "conferenceRoom": null,
              "extension": null,
              "numberCountry": null
          },
          "ivr": null,
          "huntGroup": null,
          "voicemailUser": null,
          "user": null,
          "queue": null,
          "locution": null,
          "conferenceRoom": null,
          "extension": null,
          "numberCountry": null
      }
    """

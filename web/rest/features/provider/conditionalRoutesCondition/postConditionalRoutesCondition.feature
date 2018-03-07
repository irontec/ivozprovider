Feature: Create conditional routes conditions
  In order to manage conditional routes conditions
  As an super admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create a conditional routes condition
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "conditional_routes_conditions" with body:
    """
      {
          "priority": 2,
          "routeType": "extension",
          "numberValue": "",
          "friendValue": "",
          "id": 1,
          "conditionalRoute": 1,
          "ivr": null,
          "huntGroup": null,
          "voicemailUser": null,
          "user": null,
          "queue": null,
          "locution": null,
          "conferenceRoom": null,
          "extension": 1,
          "numberCountry": null
      }
    """
    Then the response status code should be 201
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be equal to:
    """
      {
          "priority": 2,
          "routeType": "extension",
          "id": 2
      }
    """

  Scenario: Retrieve created conditional routes condition
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "conditional_routes_conditions/2"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
      {
          "priority": 2,
          "routeType": "extension",
          "numberValue": null,
          "friendValue": null,
          "id": 2,
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
          "extension": {
              "number": "101",
              "routeType": "user",
              "numberValue": null,
              "friendValue": null,
              "id": 1,
              "company": 1,
              "ivr": null,
              "huntGroup": null,
              "conferenceRoom": null,
              "user": 1,
              "queue": null,
              "conditionalRoute": null,
              "numberCountry": null
          },
          "numberCountry": null
      }
    """

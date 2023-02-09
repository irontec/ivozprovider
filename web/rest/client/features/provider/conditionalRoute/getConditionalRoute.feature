Feature: Retrieve conditional routes
  In order to manage conditional routes
  As a client admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the conditional routes json list
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "conditional_routes"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
      [
          {
              "name": "testConditional",
              "routetype": "user",
              "numbervalue": null,
              "friendvalue": null,
              "id": 1,
              "ivr": null,
              "huntGroup": null,
              "voicemail": null,
              "user": 1,
              "queue": null,
              "locution": null,
              "conferenceRoom": null,
              "extension": null,
              "numberCountry": null
          },
          {
              "name": "testConditional2",
              "routetype": "user",
              "numbervalue": null,
              "friendvalue": null,
              "id": 2,
              "ivr": null,
              "huntGroup": null,
              "voicemail": null,
              "user": 2,
              "queue": null,
              "locution": null,
              "conferenceRoom": null,
              "extension": null,
              "numberCountry": null
          }
      ]
    """

  Scenario: Retrieve certain conditional route json
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "conditional_routes/1"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
    """
      {
          "name": "testConditional",
          "routetype": "user",
          "numbervalue": null,
          "friendvalue": null,
          "id": 1,
          "ivr": null,
          "huntGroup": null,
          "voicemail": null,
          "user": "~",
          "queue": null,
          "locution": null,
          "conferenceRoom": null,
          "extension": null,
          "numberCountry": null
      }
    """

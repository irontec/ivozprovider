Feature: Retrieve conditional routes
  In order to manage conditional routes
  As an super admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the conditional routes json list
    Given I add Authorization header
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
              "id": 1
          },
          {
              "name": "testConditional2",
              "routetype": "user",
              "id": 2
          }
      ]
    """

  Scenario: Retrieve certain conditional route json
    Given I add Authorization header
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
          "company": "~",
          "ivr": null,
          "huntGroup": null,
          "voicemailUser": null,
          "user": "~",
          "queue": null,
          "locution": null,
          "conferenceRoom": null,
          "extension": null,
          "numberCountry": null
      }
    """

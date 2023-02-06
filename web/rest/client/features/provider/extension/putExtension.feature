Feature: Update extensions
  In order to manage extensions
  As a client admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update an extensions
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/extensions/1" with body:
      """
       {
          "number": "108",
          "routeType": "user",
          "numberValue": null,
          "friendValue": null,
          "id": 1,
          "ivr": null,
          "huntGroup": null,
          "conferenceRoom": null,
          "user": 1,
          "queue": null,
          "conditionalRoute": null,
          "numberCountry": 2,
          "voicemail": null
      }
      """
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      {
          "number": "108",
          "routeType": "user",
          "numberValue": null,
          "friendValue": null,
          "id": 1,
          "ivr": null,
          "huntGroup": null,
          "conferenceRoom": null,
          "user": 1,
          "queue": null,
          "conditionalRoute": null,
          "numberCountry": null,
          "voicemail": null
      }
      """

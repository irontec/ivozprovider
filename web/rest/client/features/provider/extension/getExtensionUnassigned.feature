Feature: Retrieve extensions
  In order to manage extensions
  As a client admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve unassigned extensions json list
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "extensions/unassigned"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      [
          {
              "number": "987",
              "routeType": null,
              "numberValue": null,
              "friendValue": null,
              "id": 4,
              "ivr": null,
              "huntGroup": null,
              "conferenceRoom": null,
              "user": null,
              "queue": null,
              "conditionalRoute": null,
              "numberCountry": null,
              "voicemail": null
          }
      ]
      """

Feature: Retrieve extensions
  In order to manage extensions
  As a client admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the extensions json list
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "extensions"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
      [
          {
              "number": "101",
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
          },
          {
              "number": "102",
              "routeType": "user",
              "numberValue": null,
              "friendValue": null,
              "id": 2,
              "ivr": null,
              "huntGroup": null,
              "conferenceRoom": null,
              "user": 2,
              "queue": null,
              "conditionalRoute": null,
              "numberCountry": null,
              "voicemail": null
          },
          {
              "number": "12346",
              "routeType": "number",
              "numberValue": "946006060",
              "friendValue": null,
              "id": 3,
              "ivr": null,
              "huntGroup": null,
              "conferenceRoom": null,
              "user": null,
              "queue": null,
              "conditionalRoute": null,
              "numberCountry": 68,
              "voicemail": null
          },
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

  Scenario: Retrieve certain extension json
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "extensions/1"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
    """
      {
          "number": "101",
          "routeType": "user",
          "numberValue": null,
          "friendValue": null,
          "id": 1,
          "ivr": null,
          "huntGroup": null,
          "conferenceRoom": null,
          "user": "~",
          "queue": null,
          "conditionalRoute": null,
          "numberCountry": null,
          "voicemail": null
      }
    """

Feature: Update conditional routes conditions
  In order to manage conditional routes conditions
  As a client admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update an conditional routes condition
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/conditional_routes_conditions/1" with body:
    """
      {
          "priority": 1,
          "routeType": "ivr",
          "numberValue": null,
          "friendValue": "",
          "conditionalRoute": 1,
          "ivr": 1,
          "huntGroup": null,
          "voicemail": null,
          "user": null,
          "queue": null,
          "locution": null,
          "conferenceRoom": null,
          "extension": null,
          "numberCountry": null,
          "matchListIds": [
            2
          ],
          "scheduleIds": [
            2
          ],
          "calendarIds": [
            2
          ],
          "routeLockIds": [
            2
          ]
      }
    """
    Then the response status code should be 200
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be equal to:
    """
      {
          "priority": 1,
          "routeType": "ivr",
          "numberValue": null,
          "friendValue": null,
          "id": 1,
          "conditionalRoute": 1,
          "ivr": 1,
          "huntGroup": null,
          "voicemail": null,
          "user": null,
          "queue": null,
          "locution": null,
          "conferenceRoom": null,
          "extension": null,
          "numberCountry": null,
          "matchListIds": [
            2
          ],
          "scheduleIds": [
            2
          ],
          "calendarIds": [
            2
          ],
          "routeLockIds": [
            2
          ]
      }
    """

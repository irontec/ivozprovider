Feature: Create calendar periods
  In order to manage calendar periods
  As a client admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create an calendar periods
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "calendar_periods" with body:
    """
      {
          "startDate": "2019-05-01",
          "endDate": "2019-06-01",
          "routeType": "extension",
          "numberValue": null,
          "calendar": 1,
          "locution": null,
          "extension": 1,
          "voicemail": null,
          "numberCountry": null
      }
    """
    Then the response status code should be 201
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be equal to:
    """
      {
          "startDate": "2019-05-01",
          "endDate": "2019-06-01",
          "routeType": "extension",
          "numberValue": null,
          "id": 2,
          "calendar": 1,
          "locution": null,
          "extension": 1,
          "voicemail": null,
          "numberCountry": null
      }
    """

  Scenario: Retrieve created calendar periods
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "calendar_periods/2"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
    """
      {
          "startDate": "2019-05-01",
          "endDate": "2019-06-01",
          "routeType": "extension",
          "numberValue": null,
          "id": 2,
          "calendar": {
              "name": "testCalendar",
              "id": 1
          },
          "locution": null,
          "extension": {
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
              "numberCountry": null
          },
          "voicemail": null,
          "numberCountry": null
      }
    """

Feature: Create calendar periods rel schedules
  In order to manage calendar periods rel schedules
  As a client admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create an calendar periods rel schedules
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "calendar_periods_rel_schedules" with body:
    """
      {
          "calendarPeriod": 1,
          "schedule": 2
      }
    """
    Then the response status code should be 201
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be equal to:
    """
      {
          "id": 2,
          "calendarPeriod": {
              "startDate": null,
              "endDate": null,
              "routeType": null,
              "numberValue": null,
              "id": 1,
              "calendar": null,
              "locution": null,
              "extension": null,
              "voicemail": null,
              "numberCountry": null,
              "scheduleIds": []
          },
          "schedule": {
              "name": null,
              "timeIn": null,
              "timeout": null,
              "monday": false,
              "tuesday": false,
              "wednesday": false,
              "thursday": false,
              "friday": false,
              "saturday": false,
              "sunday": false,
              "id": 2
          }
      }
    """

  Scenario: Retrieve created calendar periods rel schedules
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "calendar_periods_rel_schedules/2"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
    """
      {
          "id": 2,
          "calendarPeriod": {
              "startDate": "2019-01-01",
              "endDate": "2019-10-01",
              "routeType": "number",
              "numberValue": "911",
              "id": 1,
              "calendar": 1,
              "locution": null,
              "extension": null,
              "voicemail": null,
              "numberCountry": 1
          },
          "schedule": {
              "name": "anotherSchedule",
              "timeIn": "08:00:00",
              "timeout": "16:00:00",
              "monday": true,
              "tuesday": true,
              "wednesday": true,
              "thursday": true,
              "friday": true,
              "saturday": false,
              "sunday": false,
              "id": 2
          }
      }
    """

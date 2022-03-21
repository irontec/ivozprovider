Feature: Retrieve calendar periods rel schedules
  In order to manage calendar periods rel schedules
  As a client admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the calendar periods rel schedules json list
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "calendar_periods_rel_schedules"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
      [
          {
              "id": 1,
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
                  "numberCountry": 1,
                  "scheduleIds": []
              },
              "schedule": {
                  "name": "aSchedule",
                  "timeIn": "08:00:00",
                  "timeout": "16:00:00",
                  "monday": true,
                  "tuesday": true,
                  "wednesday": true,
                  "thursday": true,
                  "friday": true,
                  "saturday": false,
                  "sunday": false,
                  "id": 1
              }
          }
      ]
    """

  Scenario: Retrieve certain calendar rel schedule json
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "calendar_periods_rel_schedules/1"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
    """
      {
          "id": 1,
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
              "name": "aSchedule",
              "timeIn": "08:00:00",
              "timeout": "16:00:00",
              "monday": true,
              "tuesday": true,
              "wednesday": true,
              "thursday": true,
              "friday": true,
              "saturday": false,
              "sunday": false,
              "id": 1
          }
      }
    """

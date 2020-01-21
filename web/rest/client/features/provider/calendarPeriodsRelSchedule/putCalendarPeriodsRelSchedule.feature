Feature: Update calendar periods rel schedules
  In order to manage calendar periods rel schedules
  As a client admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update an calendar periods rel schedules
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/calendar_periods_rel_schedules/1" with body:
    """
      {
          "calendarPeriod": 1,
          "schedule": 2
      }
    """
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
              "voiceMailUser": null,
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

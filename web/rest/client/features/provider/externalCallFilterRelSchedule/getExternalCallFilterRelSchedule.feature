Feature: Retrieve external call filter rel schedules
  In order to manage external call filter rel schedules
  As an super admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the external call filter rel schedules json list
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "external_call_filter_rel_schedules"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
      [
          {
              "id": 1,
              "filter": {
                  "name": "testFilter",
                  "holidayTargetType": null,
                  "holidayNumberValue": null,
                  "outOfScheduleTargetType": null,
                  "outOfScheduleNumberValue": null,
                  "id": 1,
                  "company": 1,
                  "welcomeLocution": null,
                  "holidayLocution": null,
                  "outOfScheduleLocution": null,
                  "holidayExtension": null,
                  "outOfScheduleExtension": null,
                  "holidayVoiceMailUser": null,
                  "outOfScheduleVoiceMailUser": null,
                  "holidayNumberCountry": null,
                  "outOfScheduleNumberCountry": null
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
                  "id": 1,
                  "company": 1
              }
          }
      ]
    """

  Scenario: Retrieve certain external call filter rel schedule json
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "external_call_filter_rel_schedules/1"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
      {
          "id": 1,
          "filter": {
              "name": "testFilter",
              "holidayTargetType": null,
              "holidayNumberValue": null,
              "outOfScheduleTargetType": null,
              "outOfScheduleNumberValue": null,
              "id": 1,
              "company": 1,
              "welcomeLocution": null,
              "holidayLocution": null,
              "outOfScheduleLocution": null,
              "holidayExtension": null,
              "outOfScheduleExtension": null,
              "holidayVoiceMailUser": null,
              "outOfScheduleVoiceMailUser": null,
              "holidayNumberCountry": null,
              "outOfScheduleNumberCountry": null
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
              "id": 1,
              "company": 1
          }
      }
    """

Feature: Create external call filter rel schedules
  In order to manage external call filter rel schedules
  As a client admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create an external call filter rel schedule
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/external_call_filter_rel_schedules" with body:
      """
      {
          "filter": 1,
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
          "filter": {
              "name": "testFilter",
              "holidayEnabled": true,
              "holidayTargetType": null,
              "holidayNumberValue": null,
              "outOfScheduleEnabled": true,
              "outOfScheduleTargetType": null,
              "outOfScheduleNumberValue": null,
              "id": 1,
              "welcomeLocution": null,
              "holidayLocution": null,
              "outOfScheduleLocution": null,
              "holidayExtension": null,
              "outOfScheduleExtension": null,
              "holidayVoicemail": null,
              "outOfScheduleVoicemail": null,
              "holidayNumberCountry": null,
              "outOfScheduleNumberCountry": null
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

  Scenario: Retrieve created external call filter rel schedules
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "external_call_filter_rel_schedules/2"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      {
          "id": 2,
          "filter": {
              "name": "testFilter",
              "holidayEnabled": true,
              "holidayTargetType": null,
              "holidayNumberValue": null,
              "outOfScheduleEnabled": true,
              "outOfScheduleTargetType": null,
              "outOfScheduleNumberValue": null,
              "id": 1,
              "welcomeLocution": null,
              "holidayLocution": null,
              "outOfScheduleLocution": null,
              "holidayExtension": null,
              "outOfScheduleExtension": null,
              "holidayVoicemail": null,
              "outOfScheduleVoicemail": null,
              "holidayNumberCountry": null,
              "outOfScheduleNumberCountry": null
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

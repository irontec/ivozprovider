Feature: Retrieve external call filter rel calendars
  In order to manage external call filter rel calendars
  As a client admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the external call filter rel calendars json list
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "external_call_filter_rel_calendars"
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
              "calendar": {
                  "name": "testCalendar",
                  "id": 1
              }
          }
      ]
      """

  Scenario: Retrieve certain external call filter rel calendars json
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "external_call_filter_rel_calendars/1"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      {
          "id": 1,
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
          "calendar": {
              "name": "testCalendar",
              "id": 1
          }
      }
      """

Feature: Retrieve external call filter rel calendars
  In order to manage external call filter rel calendars
  As an super admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the external call filter rel calendars json list
    Given I add Authorization header
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
              "calendar": {
                  "name": "testCalendar",
                  "id": 1,
                  "company": 1
              }
          }
      ]
    """

  Scenario: Retrieve certain external call filter rel calendars json
    Given I add Authorization header
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
          "calendar": {
              "name": "testCalendar",
              "id": 1,
              "company": 1
          }
      }
    """

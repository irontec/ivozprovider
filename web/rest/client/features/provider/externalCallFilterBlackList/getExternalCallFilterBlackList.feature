Feature: Retrieve external call filter black lists
  In order to manage external call filter black lists
  As a client admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the external call filter black lists json list
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "external_call_filter_black_lists"
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
              "matchlist": {
                  "name": "testMatchlist",
                  "id": 1,
                  "generic": false
              }
          }
      ]
      """

  Scenario: Retrieve certain external call filter black list json
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "external_call_filter_black_lists/1"
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
          "matchlist": {
              "name": "testMatchlist",
              "id": 1,
              "generic": false
          }
      }
      """

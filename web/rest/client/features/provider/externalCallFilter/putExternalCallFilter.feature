Feature: Update external call filters
  In order to manage external call filters
  As an super admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update an external call filter
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/external_call_filters/1" with body:
    """
      {
          "name": "updatedFilter",
          "holidayTargetType": "number",
          "holidayNumberValue": "946002021",
          "outOfScheduleTargetType": "number",
          "outOfScheduleNumberValue": "946002022",
          "id": 1,
          "company": 2,
          "welcomeLocution": null,
          "holidayLocution": null,
          "outOfScheduleLocution": null,
          "holidayExtension": null,
          "outOfScheduleExtension": null,
          "holidayVoiceMailUser": null,
          "outOfScheduleVoiceMailUser": null,
          "holidayNumberCountry": 1,
          "outOfScheduleNumberCountry": 1
      }
    """
    Then the response status code should be 200
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be like:
    """
      {
          "name": "updatedFilter",
          "holidayTargetType": "number",
          "holidayNumberValue": "946002021",
          "outOfScheduleTargetType": "number",
          "outOfScheduleNumberValue": "946002022",
          "id": 1,
          "company": "~",
          "welcomeLocution": null,
          "holidayLocution": null,
          "outOfScheduleLocution": null,
          "holidayExtension": null,
          "outOfScheduleExtension": null,
          "holidayVoiceMailUser": null,
          "outOfScheduleVoiceMailUser": null,
          "holidayNumberCountry": {
              "code": "ES",
              "countryCode": "+34",
              "id": 1,
              "name": {
                  "en": "Spain",
                  "es": "España"
              },
              "zone": {
                  "en": "Europe",
                  "es": "Europa"
              }
          },
          "outOfScheduleNumberCountry": {
              "code": "ES",
              "countryCode": "+34",
              "id": 1,
              "name": {
                  "en": "Spain",
                  "es": "España"
              },
              "zone": {
                  "en": "Europe",
                  "es": "Europa"
              }
          }
      }
    """

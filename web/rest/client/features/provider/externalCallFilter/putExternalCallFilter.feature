Feature: Update external call filters
  In order to manage external call filters
  As a client admin
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
          "welcomeLocution": null,
          "holidayLocution": null,
          "outOfScheduleLocution": null,
          "holidayExtension": null,
          "outOfScheduleExtension": null,
          "holidayVoiceMailUser": null,
          "outOfScheduleVoiceMailUser": null,
          "holidayNumberCountry": 68,
          "outOfScheduleNumberCountry": 68,
          "scheduleIds": [],
          "calendarIds": [
            1
          ],
          "whiteListIds": [
            2
          ],
          "blackListIds": [
            3
          ]
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
              "id": 68,
              "name": {
                  "en": "Spain",
                  "es": "España",
                  "ca": "España"
              },
              "zone": {
                  "en": "Europe",
                  "es": "Europa",
                  "ca": "Europa"
              }
          },
          "outOfScheduleNumberCountry": {
              "code": "ES",
              "countryCode": "+34",
              "id": 68,
              "name": {
                  "en": "Spain",
                  "es": "España",
                  "ca": "España"
              },
              "zone": {
                  "en": "Europe",
                  "es": "Europa",
                  "ca": "Europa"
              }
          },
          "scheduleIds": [],
          "calendarIds": [
            1
          ],
          "whiteListIds": [
            2
          ],
          "blackListIds": [
            3
          ]
      }
    """

Feature: Create external call filters
  In order to manage external call filters
  As a client admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create an external call filter
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/external_call_filters" with body:
    """
      {
          "name": "newFilter",
          "holidayTargetType": "number",
          "holidayNumberValue": "946002021",
          "outOfScheduleEnabled": true,
          "outOfScheduleTargetType": "number",
          "outOfScheduleNumberValue": "946002022",
          "welcomeLocution": null,
          "holidayLocution": null,
          "outOfScheduleLocution": null,
          "holidayExtension": null,
          "outOfScheduleExtension": null,
          "holidayVoicemail": null,
          "outOfScheduleVoicemail": null,
          "holidayNumberCountry": 77,
          "outOfScheduleNumberCountry": 77,
          "scheduleIds": [
            2
          ],
          "calendarIds": [
            2
          ],
          "whiteListIds": [
            2
          ],
          "blackListIds": [
            2
          ]
      }
    """
    Then the response status code should be 201
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be equal to:
    """
      {
          "name": "newFilter",
          "holidayTargetType": "number",
          "holidayNumberValue": "946002021",
          "outOfScheduleEnabled": true,
          "outOfScheduleTargetType": "number",
          "outOfScheduleNumberValue": "946002022",
          "id": 2,
          "welcomeLocution": null,
          "holidayLocution": null,
          "outOfScheduleLocution": null,
          "holidayExtension": null,
          "outOfScheduleExtension": null,
          "holidayVoicemail": null,
          "outOfScheduleVoicemail": null,
          "holidayNumberCountry": {
              "code": "GB",
              "countryCode": "+44",
              "id": 77,
              "name": {
                  "en": "United Kingdom",
                  "es": "Reino Unido",
                  "ca": "Reino Unido",
                  "it": "United Kingdom"
              },
              "zone": {
                  "en": "Europe",
                  "es": "Europa",
                  "ca": "Europa",
                  "it": "Europe"
              }
          },
          "outOfScheduleNumberCountry": {
              "code": "GB",
              "countryCode": "+44",
              "id": 77,
              "name": {
                  "en": "United Kingdom",
                  "es": "Reino Unido",
                  "ca": "Reino Unido",
                  "it": "United Kingdom"
              },
              "zone": {
                  "en": "Europe",
                  "es": "Europa",
                  "ca": "Europa",
                  "it": "Europe"
              }
          },
          "scheduleIds": [
              2
          ],
          "calendarIds": [
              2
          ],
          "whiteListIds": [
              2
          ],
          "blackListIds": [
              2
          ]
      }
    """

  Scenario: Retrieve created external call filter
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "external_call_filters/2"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
    """
      {
          "name": "newFilter",
          "holidayTargetType": "number",
          "holidayNumberValue": "946002021",
          "outOfScheduleEnabled": true,
          "outOfScheduleTargetType": "number",
          "outOfScheduleNumberValue": "946002022",
          "id": 2,
          "welcomeLocution": null,
          "holidayLocution": null,
          "outOfScheduleLocution": null,
          "holidayExtension": null,
          "outOfScheduleExtension": null,
          "holidayVoicemail": null,
          "outOfScheduleVoicemail": null,
          "holidayNumberCountry": {
              "code": "GB",
              "countryCode": "+44",
              "id": 77,
              "name": {
                  "en": "United Kingdom",
                  "es": "Reino Unido",
                  "ca": "Reino Unido"
              },
              "zone": {
                  "en": "Europe",
                  "es": "Europa",
                  "ca": "Europa"
              }
          },
          "outOfScheduleNumberCountry": {
              "code": "GB",
              "countryCode": "+44",
              "id": 77,
              "name": {
                  "en": "United Kingdom",
                  "es": "Reino Unido",
                  "ca": "Reino Unido"
              },
              "zone": {
                  "en": "Europe",
                  "es": "Europa",
                  "ca": "Europa"
              }
          },
          "scheduleIds": [
            2
          ],
          "calendarIds": [
            2
          ],
          "whiteListIds": [
            2
          ],
          "blackListIds": [
            2
          ]
      }
    """

Feature: Create external call filters
  In order to manage external call filters
  As an super admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create an external call filter
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/external_call_filters" with body:
    """
      {
          "name": "newFilter",
          "holidayTargetType": "number",
          "holidayNumberValue": "946002021",
          "outOfScheduleTargetType": "number",
          "outOfScheduleNumberValue": "946002022",
          "company": 1,
          "welcomeLocution": null,
          "holidayLocution": null,
          "outOfScheduleLocution": null,
          "holidayExtension": null,
          "outOfScheduleExtension": null,
          "holidayVoiceMailUser": null,
          "outOfScheduleVoiceMailUser": null,
          "holidayNumberCountry": 2,
          "outOfScheduleNumberCountry": 2
      }
    """
    Then the response status code should be 201
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be equal to:
    """
      {
          "name": "newFilter",
          "id": 2
      }
    """

  Scenario: Retrieve created external call filter
    Given I add Authorization header
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
          "outOfScheduleTargetType": "number",
          "outOfScheduleNumberValue": "946002022",
          "id": 2,
          "company": "~",
          "welcomeLocution": null,
          "holidayLocution": null,
          "outOfScheduleLocution": null,
          "holidayExtension": null,
          "outOfScheduleExtension": null,
          "holidayVoiceMailUser": null,
          "outOfScheduleVoiceMailUser": null,
          "holidayNumberCountry": {
              "code": "GB",
              "countryCode": "+44",
              "id": 2,
              "name": {
                  "en": "United Kingdom",
                  "es": "Reino Unido"
              },
              "zone": {
                  "en": "Europe",
                  "es": "Europa"
              }
          },
          "outOfScheduleNumberCountry": {
              "code": "GB",
              "countryCode": "+44",
              "id": 2,
              "name": {
                  "en": "United Kingdom",
                  "es": "Reino Unido"
              },
              "zone": {
                  "en": "Europe",
                  "es": "Europa"
              }
          }
      }
    """

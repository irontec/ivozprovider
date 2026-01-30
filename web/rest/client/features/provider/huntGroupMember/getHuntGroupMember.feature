Feature: Retrieve hunt groups rel users
  In order to manage hunt groups rel users
  As a client admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the hunt groups rel users json list
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "hunt_group_members"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
      """
      [
          {
              "timeoutTime": 1,
              "priority": 2,
              "routeType": "number",
              "numberValue": "946002050",
              "id": 2,
              "huntGroup": {
                  "name": "testHuntGroup",
                  "description": "desc",
                  "strategy": "ringAll",
                  "ringAllTimeout": 10,
                  "noAnswerTargetType": null,
                  "noAnswerNumberValue": null,
                  "preventMissedCalls": 1,
                  "allowCallForwards": 0,
                  "id": 1,
                  "noAnswerLocution": null,
                  "noAnswerExtension": null,
                  "noAnswerVoicemail": null,
                  "noAnswerNumberCountry": null
              },
              "user": null,
              "numberCountry": {
                  "id": 68,
                  "*": "~"
              }
          },
          {
              "timeoutTime": 1,
              "priority": 1,
              "routeType": "user",
              "numberValue": null,
              "id": 1,
              "huntGroup": {
                  "name": "testHuntGroup",
                  "description": "desc",
                  "strategy": "ringAll",
                  "ringAllTimeout": 10,
                  "noAnswerTargetType": null,
                  "noAnswerNumberValue": null,
                  "preventMissedCalls": 1,
                  "allowCallForwards": 0,
                  "id": 1,
                  "noAnswerLocution": null,
                  "noAnswerExtension": null,
                  "noAnswerVoicemail": null,
                  "noAnswerNumberCountry": null
              },
              "user": {
                  "id": 1,
                  "*": "~"
              },
              "numberCountry": null
          }
      ]
      """

  Scenario: Retrieve certain hunt groups rel user json
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "hunt_group_members/1"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
      """
      {
          "timeoutTime": 1,
          "priority": 1,
          "routeType": "user",
          "numberValue": null,
          "id": 1,
          "huntGroup": {
              "name": "testHuntGroup",
              "description": "desc",
              "strategy": "ringAll",
              "ringAllTimeout": 10,
              "noAnswerTargetType": null,
              "noAnswerNumberValue": null,
              "preventMissedCalls": 1,
              "id": 1,
              "noAnswerLocution": null,
              "noAnswerExtension": null,
              "noAnswerVoicemail": null,
              "noAnswerNumberCountry": null,
              "allowCallForwards": 0
          },
          "user": "~",
          "numberCountry": null
      }
      """

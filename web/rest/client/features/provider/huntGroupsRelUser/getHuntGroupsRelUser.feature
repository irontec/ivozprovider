Feature: Retrieve hunt groups rel users
  In order to manage hunt groups rel users
  As a client admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the hunt groups rel users json list
    Given I add Company Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "hunt_groups_rel_users"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be like:
    """
      [
          {
              "timeoutTime": 1,
              "priority": 1,
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
                  "noAnswerNumberCountry": null
              },
              "routeType": "user"
          }
      ]
    """

  Scenario: Retrieve certain hunt groups rel user json
    Given I add Company Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "hunt_groups_rel_users/1"
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
              "noAnswerNumberCountry": null
          },
          "user": "~",
          "numberCountry": null
      }
    """

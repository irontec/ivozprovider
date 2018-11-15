Feature: Create hunt groups rel users
  In order to manage hunt groups rel users
  As an super admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create a hunt group rel user
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/hunt_groups_rel_users" with body:
    """
      {
          "timeoutTime": 1,
          "priority": 2,
          "id": 1,
          "huntGroup": 1,
          "user": 2
      }
    """
    Then the response status code should be 201
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be like:
    """
      {
          "timeoutTime": 1,
          "priority": 2,
          "id": 2,
          "huntGroup": {
              "name": "testHuntGroup",
              "description": "desc",
              "strategy": "ringAll",
              "ringAllTimeout": 10,
              "noAnswerTargetType": null,
              "noAnswerNumberValue": null,
              "preventMissedCalls": 1,
              "id": 1,
              "company": 1,
              "noAnswerLocution": null,
              "noAnswerExtension": null,
              "noAnswerVoiceMailUser": null,
              "noAnswerNumberCountry": null
          },
          "user": "~"
      }
    """

  Scenario: Retrieve created hunt group rel user
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "hunt_groups_rel_users/2"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
    """
      {
          "timeoutTime": 1,
          "priority": 2,
          "id": 2,
          "huntGroup": {
              "name": "testHuntGroup",
              "description": "desc",
              "strategy": "ringAll",
              "ringAllTimeout": 10,
              "noAnswerTargetType": null,
              "noAnswerNumberValue": null,
              "preventMissedCalls": 1,
              "id": 1,
              "company": 1,
              "noAnswerLocution": null,
              "noAnswerExtension": null,
              "noAnswerVoiceMailUser": null,
              "noAnswerNumberCountry": null
          },
          "user": "~"
      }
    """

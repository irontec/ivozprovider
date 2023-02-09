Feature: Update hunt groups
  In order to manage hunt groups
  As a client admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update a hunt group
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/hunt_groups/1" with body:
    """
      {
          "name": "updatedHuntGroup",
          "description": "desc",
          "strategy": "ringAll",
          "ringAllTimeout": 10,
          "noAnswerTargetType": "voicemail",
          "noAnswerNumberValue": null,
          "noAnswerLocution": null,
          "noAnswerExtension": null,
          "noAnswerVoicemail": 1,
          "noAnswerNumberCountry": null
      }
    """
    Then the response status code should be 200
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be equal to:
    """
      {
          "name": "updatedHuntGroup",
          "description": "desc",
          "strategy": "ringAll",
          "ringAllTimeout": 10,
          "noAnswerTargetType": "voicemail",
          "noAnswerNumberValue": null,
          "preventMissedCalls": 1,
          "allowCallForwards": 0,
          "id": 1,
          "noAnswerLocution": null,
          "noAnswerExtension": null,
          "noAnswerVoicemail": 1,
          "noAnswerNumberCountry": null
      }
    """

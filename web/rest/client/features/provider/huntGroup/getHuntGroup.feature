Feature: Retrieve hunt groups
  In order to manage hunt groups
  As a client admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the hunt groups json list
    Given I add Company Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "hunt_groups"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      [
          {
              "name": "testHuntGroup",
              "description": "desc",
              "strategy": "ringAll",
              "id": 1
          }
      ]
    """

  Scenario: Retrieve certain hunt group json
    Given I add Company Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "hunt_groups/1"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be like:
    """
      {
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
      }
    """

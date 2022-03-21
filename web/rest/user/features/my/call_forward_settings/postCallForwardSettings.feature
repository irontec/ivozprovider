Feature: Retrieve call forward settings
  In order to manage call forward settings
  As a user
  I need to be able to retrieve them through the API.

  @createSchema @userApiContext
  Scenario: Retrieve the call forward settings json list
    Given I add User Authorization header
     When I add "Accept" header equal to "application/json"
    And I send a "POST" request to "my/call_forward_settings" with body:
    """
      {
              "callTypeFilter": "external",
              "callForwardType": "inconditional",
              "targetType": "number",
              "numberValue": "946002054",
              "noAnswerTimeout": 0,
              "enabled": false,
              "user": 1,
              "extension": null,
              "voiceMailUser": null,
              "numberCountry": 68
          }
    """
    Then the response status code should be 201
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be like:
    """
      {
          "callTypeFilter": "external",
          "callForwardType": "inconditional",
          "targetType": "number",
          "numberValue": "946002054",
          "noAnswerTimeout": 0,
          "enabled": false,
          "id": 5,
          "user": "~",
          "extension": null,
          "voicemail": null,
          "numberCountry": "~"
      }
    """

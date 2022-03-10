Feature: Update call forward settings
  In order to manage call forward settings
  As a client admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update a call forward setting
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/call_forward_settings/1" with body:
    """
      {
        "callTypeFilter": "internal",
        "callForwardType": "inconditional",
        "targetType": "number",
        "numberValue": "946002021",
        "noAnswerTimeout": 0,
        "enabled": true,
        "user": 1,
        "friend": null,
        "extension": null,
        "voicemail": null,
        "numberCountry": 1
      }
    """
    Then the response status code should be 200
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be equal to:
    """
      {
          "callTypeFilter": "internal",
          "callForwardType": "inconditional",
          "targetType": "number",
          "numberValue": "946002021",
          "noAnswerTimeout": 0,
          "enabled": true,
          "id": 1,
          "user": 1,
          "friend": null,
          "extension": null,
          "voicemail": null,
          "numberCountry": 1,
          "residentialDevice": null,
          "retailAccount": null,
          "cfwToRetailAccount": null,
          "ddi": null
      }
    """

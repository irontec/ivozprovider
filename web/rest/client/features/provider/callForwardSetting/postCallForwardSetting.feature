Feature: Create call forward setting
  In order to manage call forward settings
  As a client admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create an call forward setting
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/call_forward_settings" with body:
    """
      {
        "callTypeFilter": "internal",
        "callForwardType": "inconditional",
        "targetType": "number",
        "numberValue": "946002020",
        "noAnswerTimeout": 0,
        "user": 2,
        "friend": null,
        "extension": null,
        "voicemail": null,
        "numberCountry": 68,
        "enabled": true
      }
    """
    Then the response status code should be 201
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be equal to:
    """
      {
          "callTypeFilter": "internal",
          "callForwardType": "inconditional",
          "targetType": "number",
          "numberValue": "946002020",
          "noAnswerTimeout": 0,
          "enabled": true,
          "id": 5,
          "user": 2,
          "friend": null,
          "extension": null,
          "voicemail": null,
          "numberCountry": 68,
          "residentialDevice": null,
          "retailAccount": null,
          "cfwToRetailAccount": null,
          "ddi": null
      }
    """

  Scenario: Retrieve created call forward setting
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "call_forward_settings/5"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
    """
      {
          "callTypeFilter": "internal",
          "callForwardType": "inconditional",
          "targetType": "number",
          "numberValue": "946002020",
          "noAnswerTimeout": 0,
          "enabled": true,
          "id": 5,
          "user": "~",
          "extension": null,
          "voicemail": null,
          "numberCountry": {
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
          }
      }
    """

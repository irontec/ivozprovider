Feature: Retrieve profile
  In order to manage profile
  As a user
  I need to be able to retrieve them through the API.

  @createSchema @userApiContext
  Scenario: Retrieve the profile json list
    Given I add User Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "my/profile"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
      {
          "name": "Alice",
          "lastname": "Allison",
          "email": "alice@democompany.com",
          "doNotDisturb": false,
          "isBoss": false,
          "maxCalls": 1,
          "id": 1,
          "bossAssistant": null,
          "timezone": {
              "tz": "Europe/Madrid",
              "comment": "mainland",
              "id": 145,
              "label": {
                  "en": "en",
                  "es": "es",
                  "ca": "ca"
              },
              "country": 68
          }
      }
    """

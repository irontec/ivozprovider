Feature: Retrieve voicemails
  In order to manage voicemails
  As a user
  I need to be able to retrieve them through the API.

  @createSchema @userApiContext
  Scenario: Retrieve the voicemails json list
    Given I add User Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "my/voicemails"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      [
          {
              "enabled": true,
              "name": "Voicemail For User1",
              "email": "alice@democompany.com",
              "id": 1
          }
      ]
      """

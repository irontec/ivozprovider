Feature: Retrieve company voicemails
  In order to manage company voicemails
  As a user
  I need to be able to retrieve them through the API.

  @createSchema @userApiContext
  Scenario: Retrieve the company voicemails json list
    Given I add User Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "my/company_voicemails"
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
              "id": 1,
              "user": 1
          },
          {
              "enabled": true,
              "name": "Voicemail Generic 1",
              "email": "generic@voicemail.com",
              "id": 3,
              "user": null
          },
          {
              "enabled": true,
              "name": "Voicemail For User2",
              "email": "bob@voicemail.com",
              "id": 4,
              "user": 2
          }
      ]
      """

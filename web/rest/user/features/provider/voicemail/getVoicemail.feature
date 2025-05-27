Feature: Retrieve voicemails
  In order to manage voicemails
  As a user
  I need to be able to retrieve them through the API.

  @createSchema @userApiContext
  Scenario: Retrieve the voicemails json list
    Given I add User Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "/voicemails"
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
              "generic": false
          },
          {
              "enabled": true,
              "name": "Voicemail Generic 1",
              "email": "generic@voicemail.com",
              "id": 3,
              "generic": true
          }
      ]
      """

  @createSchema @userApiContext
  Scenario: Retrieve a certain voicemail json
    Given I add User Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "/voicemails/1"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      {
          "enabled": true,
          "name": "Voicemail For User1",
          "email": "alice@democompany.com",
          "sendMail": true,
          "attachSound": true,
          "id": 1,
          "generic": false
      }
      """

  @createSchema @userApiContext
  Scenario: Retrieve a certain voicemail belonging to another user json
    Given I add User Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "/voicemails/2"
     Then the response status code should be 404
      And the header "Content-Type" should be equal to "application/problem+json; charset=utf-8"
      And the JSON should be like:
      """
      {
        "detail": "Not Found"
      }
      """

  @createSchema @userApiContext
  Scenario: Retrieve a generic voicemail assigned to the user
    Given I add User Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "/voicemails/3"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      {
          "enabled": true,
          "name": "Voicemail Generic 1",
          "email": "generic@voicemail.com",
          "sendMail": true,
          "attachSound": false,
          "id": 3,
          "generic": true
      }
      """

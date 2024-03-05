Feature: Update voicemails
  In order to manage voicemails
  As a user
  I need to be able to update them through the API.

  @createSchema @userApiContext
  Scenario: Update a voicemail
    Given I add User Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/voicemails/1" with body:
      """
      {
          "name": "readOnlyName",
          "email": "readOnlyEmail",
          "sendMail": false,
          "attachSound": false,
          "enabled": false
      }
      """
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      {
          "enabled": false,
          "name": "Voicemail For User1",
          "email": "alice@democompany.com",
          "sendMail": false,
          "attachSound": false,
          "id": 1
      }
      """

  Scenario: Update a voicemail belonging to another user
    Given I add User Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/voicemails/2" with body:
      """
      {
          "name": "updatedGeneric",
      }
      """
     Then the response status code should be 404

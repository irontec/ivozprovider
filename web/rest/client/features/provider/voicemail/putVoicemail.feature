Feature: Update voicemails
  In order to manage voicemails
  As a client admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update a voicemail
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/voicemails/4" with body:
    """
      {
          "name": "updatedGeneric",
          "email": "updated@voicemail.com",
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
          "name": "updatedGeneric",
          "email": "updated@voicemail.com",
          "sendMail": false,
          "attachSound": false,
          "id": 4,
          "user": 2,
          "residentialDevice": null,
          "company": 1,
          "locution": null
      }
    """

Feature: Manage voicemail messages
  In order to manage voicemail messages
  As a user
  I need to be able to delete them through the API.

  @createSchema @userApiContext
  Scenario: Remove a voicemail message
    Given I add User Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "DELETE" request to "/voicemail_messages/1"
     Then the response status code should be 204

  @createSchema @userApiContext
  Scenario: Remove a voicemail message belonging to another user
    Given I add User Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "DELETE" request to "/voicemail_messages/2"
     Then the response status code should be 404

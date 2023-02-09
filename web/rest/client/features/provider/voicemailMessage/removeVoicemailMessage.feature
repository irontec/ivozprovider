Feature: Manage voicemail messages
  In order to manage voicemail messages
  As a client admin
  I need to be able to delete them through the API.

  @createSchema
  Scenario: Remove a voicemail message
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "DELETE" request to "/voicemail_messages/3"
     Then the response status code should be 204

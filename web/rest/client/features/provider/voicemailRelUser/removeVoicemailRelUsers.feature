Feature: Manage voicemail rel users
  In order to manage voicemail rel users
  as a client admin
  I need to be able to delete them through the API.

  @createSchema
  Scenario: Remove a voicemail rel users
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "DELETE" request to "voicemail_rel_users/1"
     Then the response status code should be 204

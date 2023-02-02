Feature: Manage voicemails
  In order to manage voicemails
  As a client admin
  I need to be able to delete them through the API.

  @createSchema
  Scenario: Remove a voicemail
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "DELETE" request to "/voicemails/3"
     Then the response status code should be 204

  Scenario: Remove a voicemail from a user
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "DELETE" request to "/voicemails/1"
     Then the response status code should be 403

  Scenario: Remove a voicemail from a residential device
    Given I add Residential Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "DELETE" request to "/voicemails/2"
     Then the response status code should be 403

  Scenario: Remove a voicemail from another company
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "DELETE" request to "/voicemails/5"
     Then the response status code should be 404

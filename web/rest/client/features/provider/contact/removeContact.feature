Feature: Manage contacts
  In order to manage contacts
  As a client admin
  I need to be able to delete them through the API.

  @createSchema
  Scenario: Remove a contact
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "DELETE" request to "/contacts/1"
     Then the response status code should be 204

  Scenario: Remove a contact from a user
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "DELETE" request to "/contacts/2"
     Then the response status code should be 403

  Scenario: Remove a contact from another company
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "DELETE" request to "/contacts/4"
     Then the response status code should be 404

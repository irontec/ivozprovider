Feature: Manage faxes in outs
  In order to manage faxes in outs
  As a client admin
  I need to be able to delete them through the API.

  @createSchema
  Scenario: Remove a faxes
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "DELETE" request to "/faxes_in_outs/1"
     Then the response status code should be 204

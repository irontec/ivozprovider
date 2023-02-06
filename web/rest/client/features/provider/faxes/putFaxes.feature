Feature: Update faxes
  In order to manage faxes
  As a client admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update a fax
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/faxes/1" with body:
      """
      {
          "name": "Updated Fax",
          "email": "something@irontec.com",
          "sendByEmail": true,
          "outgoingDdi": 1
      }
      """
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      {
          "name": "Updated Fax",
          "email": "something@irontec.com",
          "sendByEmail": true,
          "id": 1,
          "outgoingDdi": 1
      }
      """

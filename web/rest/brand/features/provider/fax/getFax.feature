Feature: Retrieve faxes status
  In order to manage faxes status
  As a brand admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the faxes status json list
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "faxes"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      [
          {
              "name": "Test Fax",
              "email": null,
              "sendByEmail": false,
              "id": 1,
              "outgoingDdi": null
          }
      ]
      """

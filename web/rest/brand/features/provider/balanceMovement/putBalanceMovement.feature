Feature: Manage balance movements
  In order to manage balance movements
  As a brand admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update a balance movement
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/balance_movements/1" with body:
      """
      {
          "amount": 500,
          "balance": 567.23,
          "createdOn": "2022-09-02 10:17:10",
          "company": null,
          "carrier": 1
      }
      """
     Then the response status code should be 405

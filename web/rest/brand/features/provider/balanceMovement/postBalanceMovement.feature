Feature: Manage balance movements
  In order to manage balance movements
  As a brand admin
  I need to won't be able to create them through the API.

  @createSchema
  Scenario: Cannot Create balance movements
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/balance_movements" with body:
      """
      {
          "amount": 500,
          "balance": 567.23,
          "createdOn": "2022-09-02 10:17:10",
          "id": 3,
          "company": null,
          "carrier": 1
      }
      """
     Then the response status code should be 405

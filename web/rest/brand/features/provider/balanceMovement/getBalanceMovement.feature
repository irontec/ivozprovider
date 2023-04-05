Feature: Manage balance movements
  In order to manage balance movements
  As a brand admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the balance movement json list
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "balance_movements"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      [
          {
              "amount": 10,
              "balance": 10,
              "createdOn": "2022-09-02 12:17:10",
              "id": 1,
              "company": 1,
              "carrier": null
          },
          {
              "amount": 25,
              "balance": 27,
              "createdOn": "2022-09-02 12:17:11",
              "id": 2,
              "company": 1,
              "carrier": null
          },
          {
              "amount": 500,
              "balance": 567.23,
              "createdOn": "2022-09-02 12:17:12",
              "id": 3,
              "company": null,
              "carrier": 1
          }
      ]
      """

  Scenario: Retrieve certain balance movement json
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "balance_movements/1"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
      """
       {
          "amount": 10,
          "balance": 10,
          "createdOn": "2022-09-02 12:17:10",
          "id": 1,
          "company": "~",
          "carrier": null
      }
      """

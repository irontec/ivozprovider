Feature: Manage balance movements
  In order to manage balance movements
  As a brand admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create balance movements
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
    Then the response status code should be 201
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be equal to:
    """
      {
          "amount": 500,
          "balance": 567.23,
          "createdOn": "2022-09-02 10:17:10",
          "id": 4,
          "company": null,
          "carrier": 1
      }
    """

  Scenario: Retrieve created balance movement
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "balance_movements/4"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
    """
      {
          "amount": 500,
          "balance": 567.23,
          "createdOn": "2022-09-02 10:17:10",
          "id": 4,
          "company": null,
          "carrier": "~"
      }
    """

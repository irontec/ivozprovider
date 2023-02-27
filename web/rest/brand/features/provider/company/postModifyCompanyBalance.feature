Feature: Modify company balances
  In order to manage company balances
  As a brand admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Increment a company balance
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/x-www-form-urlencoded"
      And I add "Accept" header equal to "application/json"
     When I send a "POST" request to "/company/1/modify_balance" with parameters:
      | key       | value     |
      | operation | increment |
      | amount    | 10        |
     Then the response status code should be 201
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
      """
      {
          "name": "DemoCompany",
          "domainUsers": "127.0.0.1",
          "billingMethod": "prepaid",
          "balance": 11.2,
          "id": 1
      }
      """

  @createSchema
  Scenario: Decrement a company balance
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/x-www-form-urlencoded"
      And I add "Accept" header equal to "application/json"
     When I send a "POST" request to "/company/1/modify_balance" with parameters:
      | key       | value     |
      | operation | decrement |
      | amount    | 1         |
     Then the response status code should be 201
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
      """
      {
          "name": "DemoCompany",
          "domainUsers": "127.0.0.1",
          "billingMethod": "prepaid",
          "balance": 0.2,
          "id": 1
      }
      """

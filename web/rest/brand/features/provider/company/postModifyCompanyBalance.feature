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
      | value     | 10        |
     Then the response status code should be 400

  Scenario: Decrement a company balance
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/x-www-form-urlencoded"
      And I add "Accept" header equal to "application/json"
     When I send a "POST" request to "/company/1/modify_balance" with parameters:
      | key       | value     |
      | operation | increment |
      | value     | 10        |
     Then the response status code should be 400

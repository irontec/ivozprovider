Feature: Update invoices
  In order to manage invoices
  as a super admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update an invoices
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/invoices/1" with body:
      """
      {
          "username": "newUserName",
      }
      """
     Then the response status code should be 404

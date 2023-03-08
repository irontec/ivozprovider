Feature: Create invoices
  In order to manage invoices
  as a super admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create an invoices
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/invoices" with body:
      """
      {
          "username": "post-test",
      }
      """
     Then the response status code should be 405

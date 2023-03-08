Feature: Manage invoices
  In order to manage invoices
  as a super admin
  I need to be able to delete them through the API.

  @createSchema
  Scenario: Remove a invoice
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "DELETE" request to "/invoices/3"
     Then the response status code should be 404

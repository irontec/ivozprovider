Feature: Manage invoice
  In order to manage invoice
  As an super admin
  I need to be able to delete them through the API.

  @createSchema
  Scenario: Remove a invoice
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "DELETE" request to "/invoices/1"
     Then the response status code should be 204

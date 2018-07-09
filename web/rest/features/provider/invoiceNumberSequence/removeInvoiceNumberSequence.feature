Feature: Manage invoice number sequences
  In order to manage invoice number sequences
  As an super admin
  I need to be able to delete them through the API.

  @createSchema
  Scenario: Remove a invoice number sequences
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "DELETE" request to "/invoice_number_sequences/1"
     Then the response status code should be 204
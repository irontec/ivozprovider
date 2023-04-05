Feature: Manage invoice templates
  In order to manage invoice templates
  as a super admin
  I need to be able to delete them through the API.

  @createSchema
  Scenario: Remove an invoice template
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "DELETE" request to "/invoice_templates/2"
     Then the response status code should be 204

Feature: Manage companies
  In order to manage companies
  as a super admin
  I won't to be able to delete them through the API.

  @createSchema
  Scenario: Can remove a company
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "DELETE" request to "/companies/1"
     Then the response status code should be 404

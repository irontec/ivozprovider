Feature: Delete domains
  In order to manage domains
  as a super admin
  I should not be able to delete them through the API.

  @createSchema
  Scenario: Delete a domain
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "DELETE" request to "/domains/1"
     Then the response status code should be 405

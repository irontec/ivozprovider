Feature: Delete domains
  In order to manage domains
  as a client admin
  I should not be able to delete them through the API.

  @createSchema
  Scenario: Delete a domain
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "DELETE" request to "/domains/3"
     Then the response status code should be 404

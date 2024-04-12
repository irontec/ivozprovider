Feature: Update domains
  In order to manage domains
  as a brand admin
  I should not be able to update them through the API.

  @createSchema
  Scenario: Update a domains
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/domains/5" with body:
      """
      {
      	id: 5
      }
      """
     Then the response status code should be 404

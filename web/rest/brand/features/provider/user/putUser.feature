Feature: Update users
  In order to manage users
  As a brand admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update an users
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/users/2" with body:
    """
      {
      }
    """
    Then the response status code should be 404

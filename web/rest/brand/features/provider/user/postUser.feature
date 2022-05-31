Feature: Create users
  In order to manage users
  As a brand admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Can not create an user
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/users" with body:
    """
      {
      }
    """
    Then the response status code should be 405
Feature: Manage banned addresses
  In order to manage banned addresses
  as a super admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create a banned address
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/banned_addresses" with body:
    """
      {
      }
    """
    Then the response status code should be 405

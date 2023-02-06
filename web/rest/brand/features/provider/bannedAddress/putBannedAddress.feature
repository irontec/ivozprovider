Feature: Manage banned addresses
  In order to manage banned addresses
  as a super admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update a banned address
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/banned_addresses/2" with body:
      """
      {

      }
      """
     Then the response status code should be 405

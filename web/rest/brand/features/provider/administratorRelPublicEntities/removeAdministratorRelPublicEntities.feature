Feature: Manage administrator rel public entities
  In order to manage administrator rel public entities
  as a super admin
  I need to be able to delete them through the API.

  @createSchema
  Scenario: Remove a administrator rel public entities
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "DELETE" request to "/administrator_rel_public_entities/2"
     Then the response status code should be 405

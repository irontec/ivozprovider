Feature: Manage administrator rel public entities
  In order to manage administrator rel public entities
  as a super admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create a administrator rel public entities
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/administrator_rel_public_entities" with body:
    """
      {
          "create": true,
          "read": true,
          "update": true,
          "delete": true,
          "id": 230,
          "administrator": 3,
          "publicEntity": 20
      }
    """
    Then the response status code should be 405

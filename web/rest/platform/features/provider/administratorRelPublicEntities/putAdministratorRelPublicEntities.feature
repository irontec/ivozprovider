Feature: Manage administrator rel public entities
  In order to manage administrator rel public entities
  as a super admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update a administrator rel public entities
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/administrator_rel_public_entities/71" with body:
      """
      {
          "create": true,
          "read": false,
          "update": true,
          "delete": false,
          "administrator": 6,
          "publicEntity": 20
      }
      """
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      {
          "create": true,
          "read": false,
          "update": true,
          "delete": false,
          "id": 71,
          "administrator": 6,
          "publicEntity": 20
      }
      """

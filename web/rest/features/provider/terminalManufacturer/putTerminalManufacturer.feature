Feature: Update terminal manufacturers
  In order to manage terminal manufacturers
  As an super admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update a terminal manufacturer
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/terminal_manufacturers/1" with body:
    """
      {
          "iden": "UpdatedGeneric",
          "name": "Updated SIP Manufacturer",
          "description": "Updated SIP Manufacturer",
          "id": 1
      }
    """
    Then the response status code should be 200
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be equal to:
    """
      {
          "iden": "UpdatedGeneric",
          "name": "Updated SIP Manufacturer",
          "description": "Updated SIP Manufacturer",
          "id": 1
      }
    """

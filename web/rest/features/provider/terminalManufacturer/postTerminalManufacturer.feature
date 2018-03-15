Feature: Create terminal manufacturers
  In order to manage terminal manufacturers
  As an super admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create a terminal manufacturer
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/terminal_manufacturers" with body:
    """
      {
          "iden": "New",
          "name": "New SIP Manufacturer",
          "description": "New SIP Manufacturer"
      }
    """
    Then the response status code should be 201
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be equal to:
    """
      {
          "iden": "New",
          "name": "New SIP Manufacturer",
          "id": 5
      }
    """

  Scenario: Retrieve created terminal manufacturer
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "/terminal_manufacturers/5"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
      {
          "iden": "New",
          "name": "New SIP Manufacturer",
          "description": "New SIP Manufacturer",
          "id": 5
      }
    """

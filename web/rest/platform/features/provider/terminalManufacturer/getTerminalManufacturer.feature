Feature: Retrieve terminal manufacturers
  In order to manage terminal manufacturers
  As an super admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the terminal manufacturers json list
    Given I add Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "terminal_manufacturers"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      [
          {
              "iden": "Generic",
              "name": "Generic SIP Manufacturer",
              "id": 1
          },
          {
              "iden": "Yealink",
              "name": "Yealink",
              "id": 2
          },
          {
              "iden": "Cisco",
              "name": "Cisco",
              "id": 3
          },
          {
              "iden": "Test",
              "name": "Test SIP Manufacturer",
              "id": 4
          }
      ]
    """

  Scenario: Retrieve certain terminal manufacturer json
    Given I add Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "terminal_manufacturers/1"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      {
          "iden": "Generic",
          "name": "Generic SIP Manufacturer",
          "description": "Generic SIP Manufacturer",
          "id": 1
      }
    """

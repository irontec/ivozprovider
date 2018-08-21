Feature: Create terminal models
  In order to manage terminal models
  As an super admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create a terminal model
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/terminal_models" with body:
    """
      {
          "iden": "New",
          "name": "New SIP Model",
          "description": "New SIP Model",
          "genericTemplate": "",
          "specificTemplate": "",
          "genericUrlPattern": "",
          "specificUrlPattern": "",
          "terminalManufacturer": 1
      }
    """
    Then the response status code should be 201
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be equal to:
    """
      {
          "iden": "New",
          "name": "New SIP Model",
          "id": 3
      }
    """

  Scenario: Retrieve created terminal model
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "/terminal_models/3"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
      {
          "iden": "New",
          "name": "New SIP Model",
          "description": "New SIP Model",
          "genericTemplate": "",
          "specificTemplate": "",
          "genericUrlPattern": "",
          "specificUrlPattern": "",
          "id": 3,
          "terminalManufacturer": {
              "iden": "Generic",
              "name": "Generic SIP Manufacturer",
              "description": "Generic SIP Manufacturer",
              "id": 1
          }
      }
    """

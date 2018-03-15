Feature: Update terminal models
  In order to manage terminal models
  As an super admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update a terminal model
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/terminal_models/1" with body:
    """
      {
          "iden": "Updated",
          "name": "Updated SIP Model",
          "description": "Updated SIP Model",
          "genericTemplate": "",
          "specificTemplate": "",
          "genericUrlPattern": "",
          "specificUrlPattern": "",
          "terminalManufacturer": 2
      }
    """
    Then the response status code should be 200
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be equal to:
    """
      {
          "iden": "Updated",
          "name": "Updated SIP Model",
          "description": "Updated SIP Model",
          "genericTemplate": "",
          "specificTemplate": "",
          "genericUrlPattern": "",
          "specificUrlPattern": "",
          "id": 1,
          "terminalManufacturer": {
              "iden": "Yealink",
              "name": "Yealink",
              "description": "",
              "id": 2
          }
      }
    """

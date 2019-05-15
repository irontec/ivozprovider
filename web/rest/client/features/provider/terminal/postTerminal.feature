Feature: Create terminals
  In order to manage terminals
  As an super admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create a terminal
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/terminals" with body:
    """
      {
          "name": "alice2",
          "disallow": "all",
          "allowAudio": "alaw",
          "allowVideo": null,
          "directMediaMethod": "invite",
          "password": "ZGthe7E2+5",
          "mac": "",
          "lastProvisionDate": "1970-03-04 11:12:13",
          "terminalModel": 1
      }
    """
    Then the response status code should be 201
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be equal to:
    """
      {
          "name": "alice2",
          "disallow": "all",
          "allowAudio": "alaw",
          "allowVideo": null,
          "directMediaMethod": "invite",
          "password": "ZGthe7E2+5",
          "mac": "",
          "lastProvisionDate": "1970-03-04 11:12:13",
          "t38Passthrough": "no",
          "id": 4,
          "company": 1,
          "terminalModel": 1
      }
    """

  Scenario: Retrieve created terminal
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "/terminals/4"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
    """
      {
          "name": "alice2",
          "disallow": "all",
          "allowAudio": "alaw",
          "allowVideo": null,
          "directMediaMethod": "invite",
          "password": "ZGthe7E2+5",
          "mac": "",
          "lastProvisionDate": "1970-03-04 11:12:13",
          "id": 4,
          "company": "~",
          "terminalModel": {
              "iden": "Generic",
              "name": "Generic SIP Model",
              "description": "Generic SIP Model",
              "genericTemplate": "",
              "specificTemplate": "",
              "genericUrlPattern": "",
              "specificUrlPattern": "",
              "id": 1
          }
      }
    """

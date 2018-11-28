Feature: Update terminals
  In order to manage terminals
  As an super admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update a terminal
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/terminals/1" with body:
    """
      {
          "name": "aliceUpdated",
          "disallow": "all",
          "allowAudio": "alaw",
          "allowVideo": null,
          "directMediaMethod": "invite",
          "password": "ZGthe7E2+1",
          "mac": "aa-bb-cc-dd-ee-ff",
          "lastProvisionDate": "1970-01-01 10:10:10",
          "company": 2,
          "terminalModel": 2
      }
    """
    Then the response status code should be 200
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be like:
    """
      {
          "name": "aliceUpdated",
          "disallow": "all",
          "allowAudio": "alaw",
          "allowVideo": null,
          "directMediaMethod": "invite",
          "password": "****",
          "mac": "aabbccddeeff",
          "lastProvisionDate": "1970-01-01 10:10:10",
          "id": 1,
          "company": "~",
          "terminalModel": {
              "iden": "YealinkT21P_E2",
              "name": "YealinkT21P_E2",
              "description": "",
              "genericTemplate": null,
              "specificTemplate": null,
              "genericUrlPattern": "y000000000052.cfg",
              "specificUrlPattern": "{mac}",
              "id": 2
          }
      }
    """

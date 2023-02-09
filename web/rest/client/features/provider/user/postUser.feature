Feature: Create users
  In order to manage users
  As a client admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create a user
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/users" with body:
    """
      {
          "name": "Test",
          "lastname": "",
          "email": "test@irontec.com",
          "pass": "1234",
          "doNotDisturb": false,
          "isBoss": false,
          "active": true,
          "maxCalls": 1,
          "externalIpCalls": "0",
          "gsQRCode": false,
          "callAcl": 1,
          "bossAssistant": null,
          "bossAssistantWhiteList": null,
          "transformationRuleSet": 1,
          "language": null,
          "terminal": 3,
          "extension": null,
          "timezone": 145,
          "outgoingDdi": null,
          "outgoingDdiRule": null,
          "pickupGroupIds": [
            1
          ]
      }
    """
    Then the response status code should be 201
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be like:
    """
      {
          "name": "Test",
          "lastname": "",
          "email": "test@irontec.com",
          "pass": "*****",
          "doNotDisturb": false,
          "isBoss": false,
          "active": true,
          "maxCalls": 1,
          "externalIpCalls": "0",
          "gsQRCode": false,
          "id": 3,
          "callAcl": {
              "name": "testACL",
              "defaultPolicy": "allow",
              "id": 1
          },
          "bossAssistant": null,
          "bossAssistantWhiteList": null,
          "transformationRuleSet": {
              "description": "Generic transformation for Spain",
              "internationalCode": "00",
              "trunkPrefix": "",
              "areaCode": "",
              "nationalLen": 9,
              "generateRules": false,
              "id": 1,
              "name": "~",
              "country": 68
          },
          "language": null,
          "terminal": "~",
          "extension": null,
          "timezone": {
              "tz": "Europe/Madrid",
              "comment": "mainland",
              "id": 145,
              "label": {
                  "en": "en",
                  "es": "es",
                  "ca": "ca",
                  "it": "it"
              },
              "country": 68
          },
          "outgoingDdi": null,
          "outgoingDdiRule": null,
          "voicemail": null,
          "pickupGroupIds": [
              1
          ]
      }
    """

  Scenario: Retrieve created user
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "/users/3"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
    """
      {
          "name": "Test",
          "lastname": "",
          "email": "test@irontec.com",
          "pass": "*****",
          "doNotDisturb": false,
          "isBoss": false,
          "active": true,
          "maxCalls": 1,
          "externalIpCalls": "0",
          "gsQRCode": false,
          "id": 3,
          "callAcl": {
              "name": "testACL",
              "defaultPolicy": "allow",
              "id": 1
          },
          "bossAssistant": null,
          "bossAssistantWhiteList": null,
          "transformationRuleSet": {
              "description": "Generic transformation for Spain",
              "internationalCode": "00",
              "trunkPrefix": "",
              "areaCode": "",
              "nationalLen": 9,
              "generateRules": false,
              "id": 1,
              "name": {
                  "en": "en",
                  "es": "es",
                  "ca": "ca"
              },
              "country": 68
          },
          "language": null,
          "terminal": {
              "name": "testTerminal",
              "disallow": "all",
              "allowAudio": "alaw",
              "allowVideo": null,
              "directMediaMethod": "invite",
              "password": "fLgQYa6-56",
              "mac": "0011223344aa",
              "lastProvisionDate": null,
              "t38Passthrough": "no",
              "id": 3,
              "terminalModel": 1
          },
          "extension": null,
          "timezone": {
              "tz": "Europe/Madrid",
              "comment": "mainland",
              "id": 145,
              "label": {
                  "en": "en",
                  "es": "es"
              },
              "country": 68
          },
          "outgoingDdi": null,
          "outgoingDdiRule": null,
          "voicemail": null,
          "pickupGroupIds": [
            1
          ]
      }
    """

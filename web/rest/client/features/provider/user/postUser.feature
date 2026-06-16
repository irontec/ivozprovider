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
          "name": "Fernando",
          "lastname": "Lopez",
          "email": "fernando@irontec.com",
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
          "name": "Fernando",
          "lastname": "Lopez",
          "email": "fernando@irontec.com",
          "pass": "*****",
          "doNotDisturb": false,
          "isBoss": false,
          "active": true,
          "maxCalls": 1,
          "externalIpCalls": "0",
          "gsQRCode": false,
          "id": 4,
          "callAcl": {
              "name": "testACL",
              "defaultPolicy": "allow",
              "id": 1
          },
          "bossAssistant": null,
          "bossAssistantWhiteList": null,
          "transformationRuleSet": {
              "description": "Brand 1 transformation for Spain",
              "internationalCode": "00",
              "trunkPrefix": "",
              "areaCode": "",
              "nationalLen": 9,
              "generateRules": false,
              "id": 1,
              "name": {
                  "en": "Brand 1 transformation for Spain",
                  "es": "Marca 1 tansformacion para España",
                  "ca": "Marca 1 tansformacion para España",
                  "it": "Brand 1 transformation for Spain",
                  "eu": "Brand 1 transformation for Spain"
              },
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
                  "it": "it",
                  "eu": "eu"
              },
              "country": 68
          },
          "outgoingDdi": null,
          "outgoingDdiRule": null,
          "voicemail": null,
          "pickupGroupIds": [
              1
          ],
          "rejectCallMethod": "rfc",
          "multiContact": true,
          "useDefaultLocation": true,
          "location": {
              "name": "testLocation",
              "description": "Test Location description",
              "id": 1,
              "survivalDevice": 1,
              "userIds": []
          },
          "contact": null
      }
      """

  Scenario: Retrieve created user
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "/users/4"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
      """
      {
          "name": "Fernando",
          "lastname": "Lopez",
          "email": "fernando@irontec.com",
          "pass": "*****",
          "doNotDisturb": false,
          "isBoss": false,
          "active": true,
          "maxCalls": 1,
          "externalIpCalls": "0",
          "gsQRCode": false,
          "id": 4,
          "callAcl": {
              "name": "testACL",
              "defaultPolicy": "allow",
              "id": 1
          },
          "bossAssistant": null,
          "bossAssistantWhiteList": null,
          "transformationRuleSet": {
              "description": "Brand 1 transformation for Spain",
              "internationalCode": "00",
              "trunkPrefix": "",
              "areaCode": "",
              "nationalLen": 9,
              "generateRules": false,
              "id": 1,
              "name": {
                  "en": "Brand 1 transformation for Spain",
                  "es": "Marca 1 tansformacion para España",
                  "ca": "Marca 1 tansformacion para España",
                  "it": "Brand 1 transformation for Spain",
                  "eu": "Brand 1 transformation for Spain"
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
              "terminalModel": 1,
              "rtpEncryption": false
          },
          "extension": null,
          "timezone": {
              "tz": "Europe/Madrid",
              "comment": "mainland",
              "id": 145,
              "label": {
                  "en": "en",
                  "es": "es",
                  "ca": "ca",
                  "it": "it",
                  "eu": "eu"
              },
              "country": 68
          },
          "outgoingDdi": null,
          "outgoingDdiRule": null,
          "voicemail": null,
          "pickupGroupIds": [
              1
          ],
          "rejectCallMethod": "rfc",
          "multiContact": true,
          "useDefaultLocation": true,
          "location": {
              "id": 1,
              "*": "~"
          },
          "contact": null
      }
      """

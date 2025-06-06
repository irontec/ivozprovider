Feature: Retrieve users
  In order to manage users
  As a client admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the users json list
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "users"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      [
            {
                "name": "Alice",
                "lastname": "Allison",
                "email": "alice@democompany.com",
                "active": true,
                "id": 1,
                "terminal": 1,
                "extension": null,
                "outgoingDdi": 3,
                "status": [
                    {
                        "contact": "sip:yealinktest@10.10.1.106:5060",
                        "received": "sip:212.64.172.23:5060",
                        "publicReceived": true,
                        "expires": "2031-01-01 00:59:59",
                        "userAgent": "Yealink SIP-T23G 44.80.0.130"
                    }
                ]
            },
            {
                "name": "Bob",
                "lastname": "Bobson",
                "email": "bob@democompany.com",
                "active": true,
                "id": 2,
                "terminal": 2,
                "extension": null,
                "outgoingDdi": null,
                "status": []
            },
            {
                "name": "Joe",
                "lastname": "Doe",
                "email": "joe@democompany.com",
                "active": true,
                "id": 3,
                "terminal": 4,
                "extension": 2,
                "outgoingDdi": null,
                "status": []
            }
      ]
      """

  Scenario: Retrieve certain user json
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "users/1"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
      """
      {
          "name": "Alice",
          "lastname": "Allison",
          "email": "alice@democompany.com",
          "pass": "*****",
          "doNotDisturb": false,
          "isBoss": false,
          "active": true,
          "maxCalls": 1,
          "externalIpCalls": "0",
          "gsQRCode": false,
          "id": 1,
          "callAcl": null,
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
                  "it": "Brand 1 transformation for Spain"
              },
              "country": 68
          },
          "language": null,
          "terminal": {
              "name": "alice",
              "disallow": "all",
              "allowAudio": "alaw",
              "allowVideo": null,
              "directMediaMethod": "invite",
              "password": "AUfVkn498_",
              "mac": null,
              "lastProvisionDate": null,
              "t38Passthrough": "no",
              "id": 1,
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
          "outgoingDdi": "~",
          "outgoingDdiRule": null,
          "voicemail": null,
          "pickupGroupIds": [],
          "useDefaultLocation": true,
          "location": {
            "id": 1
          }
      }
      """

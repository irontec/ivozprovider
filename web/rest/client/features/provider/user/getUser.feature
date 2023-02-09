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
              "id": 1,
              "terminal": 1,
              "extension": null,
              "outgoingDdi": null
          },
          {
              "name": "Bob",
              "lastname": "Bobson",
              "id": 2,
              "terminal": 2,
              "extension": null,
              "outgoingDdi": null
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
          "outgoingDdi": null,
          "outgoingDdiRule": null,
          "voicemail": null,
          "pickupGroupIds": []
      }
    """

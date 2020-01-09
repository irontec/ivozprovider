Feature: Update users
  In order to manage users
  As a client admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update a schedule
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/users/1" with body:
    """
      {
          "name": "Updated",
          "lastname": "User",
          "email": "alice@democompany.com",
          "doNotDisturb": false,
          "isBoss": false,
          "active": true,
          "maxCalls": 1,
          "externalIpCalls": "0",
          "voicemailEnabled": true,
          "voicemailSendMail": true,
          "voicemailAttachSound": true,
          "gsQRCode": false,
          "id": 1,
          "callAcl": null,
          "bossAssistant": null,
          "bossAssistantWhiteList": null,
          "transformationRuleSet": 1,
          "language": null,
          "terminal": 1,
          "extension": null,
          "timezone": 145,
          "outgoingDdi": null,
          "outgoingDdiRule": null,
          "voicemailLocution": null,
          "pickupGroupIds": [
            1
          ]
      }
    """
    Then the response status code should be 200
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be like:
    """
      {
          "name": "Updated",
          "lastname": "User",
          "email": "alice@democompany.com",
          "pass": "*****",
          "doNotDisturb": false,
          "isBoss": false,
          "active": true,
          "maxCalls": 1,
          "externalIpCalls": "0",
          "voicemailEnabled": true,
          "voicemailSendMail": true,
          "voicemailAttachSound": true,
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
              "mac": "",
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
                  "es": "es",
                  "ca": "ca"
              },
              "country": 68
          },
          "outgoingDdi": null,
          "outgoingDdiRule": null,
          "voicemailLocution": null,
          "pickupGroupIds": [
            1
          ]
      }
    """

  Scenario: Update a password
    Given I add Company Authorization header
    When I add "Content-Type" header equal to "application/json"
    And I add "Accept" header equal to "application/json"
    And I send a "PUT" request to "/users/1" with body:
    """
      {
          "pass": "newPass",
          "oldPass": "changeme"
      }
    """
    Then the response status code should be 200


  Scenario: Active user requires a password
    Given I add Company Authorization header
    When I add "Content-Type" header equal to "application/json"
    And I add "Accept" header equal to "application/json"
    And I send a "PUT" request to "/users/1" with body:
    """
      {
          "pass": null,
          "oldPass": "changeme"
      }
    """
    Then the response status code should be 400

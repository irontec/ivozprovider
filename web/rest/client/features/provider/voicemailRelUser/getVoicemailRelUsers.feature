Feature: Manage voicemail rel users
  In order to manage voicemail rel users
  as a client admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the voicemail rel users json list
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "/voicemail_rel_users"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      [
          {
              "id": 1,
              "user": 1,
              "voicemail": 3
          }
      ]
      """

  @createSchema
  Scenario: Retrieve certain voicemail rel users json
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "voicemail_rel_users/1"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      {
          "id": 1,
          "user": {
              "name": "Alice",
              "lastname": "Allison",
              "email": "alice@democompany.com",
              "pass": "*****",
              "doNotDisturb": false,
              "isBoss": false,
              "active": true,
              "maxCalls": 1,
              "externalIpCalls": "0",
              "rejectCallMethod": "rfc",
              "multiContact": true,
              "gsQRCode": false,
              "useDefaultLocation": true,
              "id": 1,
              "callAcl": null,
              "bossAssistant": null,
              "bossAssistantWhiteList": null,
              "transformationRuleSet": 1,
              "language": null,
              "terminal": 1,
              "extension": null,
              "timezone": 145,
              "outgoingDdi": 3,
              "outgoingDdiRule": null,
              "location": 1,
              "voicemail": null,
              "contact": null
          },
          "voicemail": {
              "enabled": true,
              "name": "Voicemail Generic 1",
              "email": "generic@voicemail.com",
              "sendMail": true,
              "attachSound": false,
              "id": 3,
              "user": null,
              "residentialDevice": null,
              "company": 1,
              "locution": null
          }
      }
      """

Feature: Manage voicemail rel users
  In order to manage voicemail rel users
  as a client admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create a voicemail rel users
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/voicemail_rel_users" with body:
      """
      {
        "user": 2,
        "voicemail": 2
      }
      """
     Then the response status code should be 201

  Scenario: Retrieve created voicemail rel users json
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "voicemail_rel_users/2"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      {
          "id": 2,
          "user": {
              "name": "Bob",
              "lastname": "Bobson",
              "email": "bob@democompany.com",
              "pass": "*****",
              "doNotDisturb": false,
              "isBoss": true,
              "active": true,
              "maxCalls": 1,
              "externalIpCalls": "0",
              "rejectCallMethod": "rfc",
              "multiContact": true,
              "gsQRCode": false,
              "useDefaultLocation": false,
              "id": 2,
              "callAcl": null,
              "bossAssistant": 1,
              "bossAssistantWhiteList": null,
              "transformationRuleSet": 1,
              "language": null,
              "terminal": 2,
              "extension": null,
              "timezone": 145,
              "outgoingDdi": null,
              "outgoingDdiRule": null,
              "location": 1,
              "voicemail": null,
              "contact": null
          },
          "voicemail": {
              "enabled": true,
              "name": "Voicemail For Residential 1",
              "email": "",
              "sendMail": false,
              "attachSound": false,
              "id": 2,
              "user": null,
              "residentialDevice": 1,
              "company": 4,
              "locution": null
          }
      }
      """

  @createSchema
  Scenario: Create a voicemail rel users
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/voicemail_rel_users" with body:
      """
      {
        "user": 2,
        "voicemail": 1
      }
      """
     Then the response status code should be 403

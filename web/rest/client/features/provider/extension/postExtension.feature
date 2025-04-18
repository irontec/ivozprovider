Feature: Create extensions
  In order to manage extensions
  As a client admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create an extension
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/extensions" with body:
      """
      {
          "number": "111",
          "routeType": "user",
          "numberValue": null,
          "friendValue": null,
          "ivr": null,
          "huntGroup": null,
          "conferenceRoom": null,
          "user": 1,
          "queue": null,
          "conditionalRoute": null,
          "numberCountry": null,
          "voicemail": null
      }
      """
     Then the response status code should be 201
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      {
          "number": "111",
          "routeType": "user",
          "numberValue": null,
          "friendValue": null,
          "id": 6,
          "ivr": null,
          "huntGroup": null,
          "conferenceRoom": null,
          "user": 1,
          "queue": null,
          "conditionalRoute": null,
          "numberCountry": null,
          "voicemail": null
      }
      """

  Scenario: Retrieve created extension
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "extensions/6"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
      """
      {
          "number": "111",
          "routeType": "user",
          "numberValue": null,
          "friendValue": null,
          "id": 6,
          "ivr": null,
          "huntGroup": null,
          "conferenceRoom": null,
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
              "extension": 6,
              "timezone": 145,
              "outgoingDdi": 3,
              "outgoingDdiRule": null,
              "location": 1,
              "voicemail": null,
              "contact": null
          },
          "queue": null,
          "conditionalRoute": null,
          "numberCountry": null,
          "voicemail": null
      }
      """

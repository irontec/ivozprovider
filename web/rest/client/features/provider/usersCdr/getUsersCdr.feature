Feature: Retrieve users
  In order to manage users
  As a client admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the Users Cdr json list
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "users_cdrs"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
      """
      [
          {
              "startTime": "2018-11-22 17:54:49",
              "duration": 3600,
              "direction": "outbound",
              "caller": "102",
              "callee": "+34676896561",
              "owner": null,
              "disposition": "answered",
              "id": 1
          },
          {
              "startTime": "2018-11-22 17:54:49",
              "duration": 3600,
              "direction": "outbound",
              "caller": "102",
              "callee": "+34676896561",
              "owner": null,
              "disposition": "answered",
              "id": 2
          },
          {
              "startTime": "match:regexp(/\\d{4}-\\d{2}-\\d{2} \\d{2}:\\d{2}:\\d{2}/)",
              "duration": 3600,
              "direction": "outbound",
              "caller": "103",
              "callee": "+34676896564",
              "owner": null,
              "disposition": "answered",
              "id": 3
          }
      ]
      """

  @createSchema
  Scenario: Retrieve a specific Users Cdr element
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "users_cdrs/1"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      {
          "startTime": "2018-11-22 17:54:49",
          "duration": 3600,
          "direction": "outbound",
          "caller": "102",
          "callee": "+34676896561",
          "owner": null,
          "callid": "9297bdde-309cd48f@10.10.1.123",
          "disposition": "answered",
          "numRecordings": 0,
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
          "friend": null,
          "extension": {
              "number": "101",
              "routeType": "user",
              "numberValue": null,
              "friendValue": null,
              "id": 1,
              "ivr": null,
              "huntGroup": null,
              "conferenceRoom": null,
              "user": 1,
              "queue": null,
              "conditionalRoute": null,
              "numberCountry": null,
              "voicemail": null,
              "locution": null
          }
      }
      """

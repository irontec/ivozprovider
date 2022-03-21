Feature: Retrieve queue members
  In order to manage queue members
  As a client admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the queue members json list
    Given I add Company Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "queue_members"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      [
          {
              "penalty": 1,
              "id": 1,
              "queue": {
                  "name": "testQueue",
                  "maxWaitTime": 20,
                  "timeoutTargetType": "number",
                  "timeoutNumberValue": "946002020",
                  "maxlen": 5,
                  "fullTargetType": "number",
                  "fullNumberValue": "946002021",
                  "periodicAnnounceFrequency": 7,
                  "memberCallRest": 0,
                  "memberCallTimeout": 1,
                  "strategy": "rrmemory",
                  "weight": 5,
                  "preventMissedCalls": 1,
                  "id": 1,
                  "periodicAnnounceLocution": 1,
                  "timeoutLocution": 1,
                  "timeoutExtension": null,
                  "timeoutVoicemail": null,
                  "fullLocution": 1,
                  "fullExtension": null,
                  "fullVoicemail": null,
                  "timeoutNumberCountry": 68,
                  "fullNumberCountry": 68
              },
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
                  "voicemail": null
              }
          }
      ]
    """

  Scenario: Retrieve certain queue member json
    Given I add Company Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "queue_members/1"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      {
          "penalty": 1,
          "id": 1,
          "queue": {
              "name": "testQueue",
              "maxWaitTime": 20,
              "timeoutTargetType": "number",
              "timeoutNumberValue": "946002020",
              "maxlen": 5,
              "fullTargetType": "number",
              "fullNumberValue": "946002021",
              "periodicAnnounceFrequency": 7,
              "memberCallRest": 0,
              "memberCallTimeout": 1,
              "strategy": "rrmemory",
              "weight": 5,
              "preventMissedCalls": 1,
              "id": 1,
              "periodicAnnounceLocution": 1,
              "timeoutLocution": 1,
              "timeoutExtension": null,
              "timeoutVoicemail": null,
              "fullLocution": 1,
              "fullExtension": null,
              "fullVoicemail": null,
              "timeoutNumberCountry": 68,
              "fullNumberCountry": 68
          },
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
              "voicemail": null
          }
      }
    """

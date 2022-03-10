Feature: Create queue members
  In order to manage queue members
  As a client admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create a queue member
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/queue_members" with body:
    """
      {
          "penalty": 1,
          "queue": 1,
          "user": 2
      }
    """
    Then the response status code should be 201
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be equal to:
    """
       {
          "penalty": 1,
          "id": 2,
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
              "voicemail": null
          }
      }
    """

  Scenario: Retrieve created queue member
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "queue_members/2"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
      {
          "penalty": 1,
          "id": 2,
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
              "voicemail": null
          }
      }
    """

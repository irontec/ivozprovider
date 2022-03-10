Feature: Update queues
  In order to manage queues
  As a client admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update a queue
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/queues/1" with body:
    """
      {
          "name": "updatedQueue",
          "maxWaitTime": 10,
          "timeoutTargetType": "number",
          "timeoutNumberValue": "946002222",
          "maxlen": 5,
          "fullTargetType": "number",
          "fullNumberValue": "946003333",
          "periodicAnnounceFrequency": 7,
          "memberCallRest": 0,
          "memberCallTimeout": 1,
          "strategy": "rrmemory",
          "weight": 5,
          "periodicAnnounceLocution": 1,
          "timeoutLocution": 1,
          "timeoutExtension": null,
          "timeoutVoicemail": null,
          "fullLocution": 1,
          "fullExtension": null,
          "fullVoicemail": null,
          "timeoutNumberCountry": 68,
          "fullNumberCountry": 68
      }
    """
    Then the response status code should be 200
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be equal to:
    """
      {
          "name": "updatedQueue",
          "maxWaitTime": 10,
          "timeoutTargetType": "number",
          "timeoutNumberValue": "946002222",
          "maxlen": 5,
          "fullTargetType": "number",
          "fullNumberValue": "946003333",
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
      }
    """

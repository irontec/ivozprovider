Feature: Create queues
  In order to manage queues
  As an super admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create a queue
    Given I add Company Authorization header
    When I add "Content-Type" header equal to "application/json"
    And I add "Accept" header equal to "application/json"
    And I send a "POST" request to "/queues" with body:
    """
      {
          "name": "newQueue",
          "maxWaitTime": 10,
          "timeoutTargetType": "number",
          "timeoutNumberValue": "946002121",
          "maxlen": 5,
          "fullTargetType": "number",
          "fullNumberValue": "946002023",
          "periodicAnnounceFrequency": 7,
          "memberCallRest": 0,
          "memberCallTimeout": 1,
          "strategy": "rrmemory",
          "weight": 2,
          "company": 1,
          "periodicAnnounceLocution": 1,
          "timeoutLocution": 1,
          "timeoutExtension": null,
          "timeoutVoiceMailUser": null,
          "fullLocution": 1,
          "fullExtension": null,
          "fullVoiceMailUser": null,
          "timeoutNumberCountry": 68,
          "fullNumberCountry": 68
      }
    """
    Then the response status code should be 201
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      {
          "name": "newQueue",
          "maxWaitTime": 10,
          "timeoutTargetType": "number",
          "timeoutNumberValue": "946002121",
          "maxlen": 5,
          "fullTargetType": "number",
          "fullNumberValue": "946002023",
          "periodicAnnounceFrequency": 7,
          "memberCallRest": 0,
          "memberCallTimeout": 1,
          "strategy": "rrmemory",
          "weight": 2,
          "id": 2,
          "company": 1,
          "periodicAnnounceLocution": 1,
          "timeoutLocution": 1,
          "timeoutExtension": null,
          "timeoutVoiceMailUser": null,
          "fullLocution": 1,
          "fullExtension": null,
          "fullVoiceMailUser": null,
          "timeoutNumberCountry": 68,
          "fullNumberCountry": 68
      }
    """

  Scenario: Retrieve created queue
    Given I add Company Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "/queues/2"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be like:
    """
      {
          "name": "newQueue",
          "maxWaitTime": 10,
          "timeoutTargetType": "number",
          "timeoutNumberValue": "946002121",
          "maxlen": 5,
          "fullTargetType": "number",
          "fullNumberValue": "946002023",
          "periodicAnnounceFrequency": 7,
          "memberCallRest": 0,
          "memberCallTimeout": 1,
          "strategy": "rrmemory",
          "weight": 2,
          "id": 2,
          "company": "~",
          "periodicAnnounceLocution": {
              "name": "testLocution",
              "status": null,
              "id": 1,
              "encodedFile": {
                  "fileSize": 1,
                  "mimeType": "audio/x-wav; charset=binary",
                  "baseName": "locution.wav"
              },
              "originalFile": {
                  "fileSize": 1,
                  "mimeType": "audio/mpeg; charset=binary",
                  "baseName": "locution.mp3"
              },
              "company": 1
          },
          "timeoutLocution": {
              "name": "testLocution",
              "status": null,
              "id": 1,
              "encodedFile": {
                  "fileSize": 1,
                  "mimeType": "audio/x-wav; charset=binary",
                  "baseName": "locution.wav"
              },
              "originalFile": {
                  "fileSize": 1,
                  "mimeType": "audio/mpeg; charset=binary",
                  "baseName": "locution.mp3"
              },
              "company": 1
          },
          "timeoutExtension": null,
          "timeoutVoiceMailUser": null,
          "fullLocution": {
              "name": "testLocution",
              "status": null,
              "id": 1,
              "encodedFile": {
                  "fileSize": 1,
                  "mimeType": "audio/x-wav; charset=binary",
                  "baseName": "locution.wav"
              },
              "originalFile": {
                  "fileSize": 1,
                  "mimeType": "audio/mpeg; charset=binary",
                  "baseName": "locution.mp3"
              },
              "company": 1
          },
          "fullExtension": null,
          "fullVoiceMailUser": null,
          "timeoutNumberCountry": {
              "code": "ES",
              "countryCode": "+34",
              "id": 68,
              "name": {
                  "en": "Spain",
                  "es": "España"
              },
              "zone": {
                  "en": "Europe",
                  "es": "Europa"
              }
          },
          "fullNumberCountry": {
              "code": "ES",
              "countryCode": "+34",
              "id": 68,
              "name": {
                  "en": "Spain",
                  "es": "España"
              },
              "zone": {
                  "en": "Europe",
                  "es": "Europa"
              }
          }
      }
    """

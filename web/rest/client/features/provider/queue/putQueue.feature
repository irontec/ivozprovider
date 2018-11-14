Feature: Update queues
  In order to manage queues
  As an super admin
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
          "company": 1,
          "periodicAnnounceLocution": 1,
          "timeoutLocution": 1,
          "timeoutExtension": null,
          "timeoutVoiceMailUser": null,
          "fullLocution": 1,
          "fullExtension": null,
          "fullVoiceMailUser": null,
          "timeoutNumberCountry": 1,
          "fullNumberCountry": 1
      }
    """
    Then the response status code should be 200
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be like:
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
          "id": 1,
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
              "id": 1,
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
              "id": 1,
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

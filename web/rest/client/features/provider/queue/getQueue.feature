Feature: Retrieve queues
  In order to manage queues
  As a client admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the queues json list
    Given I add Company Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "queues"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      [
          {
              "name": "testQueue",
              "maxWaitTime": 20,
              "maxlen": 5,
              "memberCallRest": 0,
              "memberCallTimeout": 1,
              "strategy": "rrmemory",
              "weight": 5,
              "id": 1
          }
      ]
    """

  Scenario: Retrieve certain queue json
    Given I add Company Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "queues/1"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be like:
    """
       {
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
          "id": 1,
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
                  "mimeType": "audio\/mpeg; charset=binary",
                  "baseName": "locution.mp3"
              }
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
                  "mimeType": "audio\/mpeg; charset=binary",
                  "baseName": "locution.mp3"
              }
          },
          "timeoutExtension": null,
          "timeoutVoicemail": null,
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
                  "mimeType": "audio\/mpeg; charset=binary",
                  "baseName": "locution.mp3"
              }
          },
          "fullExtension": null,
          "fullVoicemail": null,
          "timeoutNumberCountry": {
              "code": "ES",
              "countryCode": "+34",
              "id": 68,
              "name": {
                  "en": "Spain",
                  "es": "España",
                  "ca": "España"
              },
              "zone": {
                  "en": "Europe",
                  "es": "Europa",
                  "ca": "Europa"
              }
          },
          "fullNumberCountry": {
              "code": "ES",
              "countryCode": "+34",
              "id": 68,
              "name": {
                  "en": "Spain",
                  "es": "España",
                  "es": "España"
              },
              "zone": {
                  "en": "Europe",
                  "es": "Europa",
                  "es": "Europa"
              }
          }
      }
    """

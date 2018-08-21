Feature: Retrieve queues
  In order to manage queues
  As an super admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the queues json list
    Given I add Authorization header
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
              "weight": 5,
              "id": 1
          }
      ]
    """

  Scenario: Retrieve certain queue json
    Given I add Authorization header
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
          "company": "~",
          "periodicAnnounceLocution": {
              "name": "testLocution",
              "status": null,
              "id": 1,
              "encodedFile": {
                  "fileSize": null,
                  "mimeType": null,
                  "baseName": null
              },
              "originalFile": {
                  "fileSize": null,
                  "mimeType": null,
                  "baseName": null
              },
              "company": 1
          },
          "timeoutLocution": {
              "name": "testLocution",
              "status": null,
              "id": 1,
              "encodedFile": {
                  "fileSize": null,
                  "mimeType": null,
                  "baseName": null
              },
              "originalFile": {
                  "fileSize": null,
                  "mimeType": null,
                  "baseName": null
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
                  "fileSize": null,
                  "mimeType": null,
                  "baseName": null
              },
              "originalFile": {
                  "fileSize": null,
                  "mimeType": null,
                  "baseName": null
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

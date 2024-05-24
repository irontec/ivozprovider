Feature: Retrieve voicemail messages
  In order to manage voicemail messages
  As a client admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the voicemail messages json list
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "voicemail_messages"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      [
          {
              "calldate": "2022-04-01 14:31:52",
              "folder": "INBOX",
              "caller": "Alice <101>",
              "duration": 21,
              "id": 4
          }
      ]
      """

  Scenario: Retrieve certain generic voicemail message json
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "voicemail_messages/4"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
      """
      {
          "calldate": "2022-04-01 14:31:52",
          "folder": "INBOX",
          "caller": "Alice <101>",
          "duration": 21,
          "id": 4,
          "recordingFile": {
              "fileSize": 182011,
              "mimeType": "audio/x-wav; charset=binary",
              "baseName": "Voicemail Recording - Generic - 2022-04-01 12:31:52.wav"
          },
          "metadataFile": {
              "fileSize": null,
              "mimeType": null,
              "baseName": null
          },
          "voicemail": {
              "enabled": true,
              "name": "Voicemail Generic 1",
              "email": "generic@voicemail.com",
              "sendMail": true,
              "attachSound": false,
              "id": 3,
              "user": null,
              "residentialDevice": null,
              "company": 1,
              "locution": null
          }
      }
      """

  Scenario: Retrieve certain users voicemail message json
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "voicemail_messages/1"
     Then the response status code should be 404

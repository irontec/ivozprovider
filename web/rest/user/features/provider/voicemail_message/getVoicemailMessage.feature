Feature: Retrieve voicemail messages
  In order to manage voicemail messages
  As a user
  I need to be able to retrieve them through the API.

  @createSchema @userApiContext
  Scenario: Retrieve the voicemail messages json list
    Given I add User Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "voicemail_messages"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      [
          {
              "calldate": "2022-03-31 14:08:43",
              "folder": "INBOX",
              "caller": "Alice <101>",
              "duration": 4,
              "id": 1
          }
      ]
      """

  Scenario: Retrieve a certain voicemail message json
    Given I add User Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "voicemail_messages/1"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
      """
      {
        "calldate": "2022-03-31 14:08:43",
        "folder": "INBOX",
        "caller": "Alice <101>",
        "duration": 4,
        "id": 1,
        "recordingFile": {
            "fileSize": 65324,
            "mimeType": "audio/x-wav; charset=binary",
            "baseName": "Voicemail Recording - Alice Allison - 2022-03-31 12:08:43.wav"
        },
        "metadataFile": {
            "fileSize": null,
            "mimeType": null,
            "baseName": null
        },
        "voicemail": {
            "enabled": true,
            "name": "Voicemail For User1",
            "email": "alice@democompany.com",
            "sendMail": true,
            "attachSound": true,
            "id": 1
        }
      }
      """

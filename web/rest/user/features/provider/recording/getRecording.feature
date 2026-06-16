Feature: Retrieve recordings
  In order to manage recordings
  As a user
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the recordings json list
    Given I add User Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "recordings"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      [
          {
              "callid": "fb504426-4e3c-11ef-af02-fc5cee56dc74",
              "calldate": "2017-01-05 01:15:15",
              "type": "ondemand",
              "duration": 5,
              "caller": "34946002020",
              "callee": "34946002021",
              "recorder": null,
              "id": 2
          }
      ]
      """

  Scenario: Retrieve certain recording json
    Given I add User Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "recordings/2"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
      """
      {
          "callid": "fb504426-4e3c-11ef-af02-fc5cee56dc74",
          "calldate": "2017-01-05 01:15:15",
          "type": "ondemand",
          "duration": 5,
          "caller": "34946002020",
          "callee": "34946002021",
          "recorder": null,
          "id": 2,
          "recordedFile": {
              "fileSize": 3276,
              "mimeType": "audio/mpeg; charset=binary",
              "baseName": "fb504426-4e3c-11ef-af02-fc5cee56dc74.0.mp3"
          },
          "user": {
              "name": "Alice",
              "lastname": "Allison",
              "email": "alice@democompany.com",
              "id": 1,
              "*": "~"
          },
          "usersCdr": {
              "id": 2,
              "*": "~"
          }
      }
      """

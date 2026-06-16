Feature: Retrieve recordings
  In order to manage recordings
  As a client admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the recordings json list
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "recordings"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      [
            {
                "callid": "7602fd7f-4153-4475-9100-d89ff70cdf76",
                "calldate": "2017-01-05 01:15:15",
                "type": "ondemand",
                "duration": 3,
                "caller": "34946002020",
                "callee": "34946002021",
                "recorder": null,
                "id": 1
            },
            {
                "callid": "fb504426-4e3c-11ef-af02-fc5cee56dc74",
                "calldate": "2017-01-05 01:15:15",
                "type": "ondemand",
                "duration": 5,
                "caller": "34946002020",
                "callee": "34946002021",
                "recorder": null,
                "id": 2
            },
            {
                "callid": "032f4836-4e3d-11ef-951b-fc5cee56dc74",
                "calldate": "2017-01-05 01:15:15",
                "type": "ddi",
                "duration": 2,
                "caller": "34946002020",
                "callee": "34946002021",
                "recorder": null,
                "id": 3
            }
      ]
      """

  Scenario: Retrieve certain recording json
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "recordings/1"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
      """
      {
          "callid": "7602fd7f-4153-4475-9100-d89ff70cdf76",
          "calldate": "2017-01-05 01:15:15",
          "type": "ondemand",
          "duration": 3,
          "caller": "34946002020",
          "callee": "34946002021",
          "recorder": null,
          "id": 1,
          "recordedFile": {
              "fileSize": 4280,
              "mimeType": "audio/mpeg; charset=binary",
              "baseName": "7602fd7f-4153-4475-9100-d89ff70cdf76.0.mp3"
          },
          "ddi": null,
          "user": null,
          "usersCdr": null,
          "billableCall": null
      }
      """

Feature: Retrieve call history
  In order to manage call history
  As a user
  I need to be able to retrieve them through the API.

  @createSchema @userApiContext
  Scenario: Retrieve the call history json list
    Given I add User Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "my/call_history"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
      """
      [
          {
              "startTime": "2018-11-22 17:54:49",
              "duration": 3600,
              "direction": "outbound",
              "caller": "102",
              "callee": "+34676896561",
              "owner": null,
              "disposition": "answered",
              "id": 1
          },
          {
              "startTime": "2018-11-22 17:54:49",
              "duration": 3600,
              "direction": "outbound",
              "caller": "102",
              "callee": "+34676896561",
              "owner": null,
              "disposition": "answered",
              "id": 2
          },
          {
              "startTime": "match:regexp(/\\d{4}-\\d{2}-\\d{2} \\d{2}:\\d{2}:\\d{2}/)",
              "duration": 3600,
              "direction": "outbound",
              "caller": "103",
              "callee": "+34676896564",
              "owner": null,
              "disposition": "answered",
              "id": 3
          }
      ]
      """

  Scenario: I can filter the call history by partial dates
    Given I add User Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "my/call_history?startTime=2018-11-22"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      [
          {
              "startTime": "2018-11-22 17:54:49",
              "duration": 3600,
              "direction": "outbound",
              "caller": "102",
              "callee": "+34676896561",
              "owner": null,
              "disposition": "answered",
              "numRecordings": 0,
              "id": 1
          },
          {
              "startTime": "2018-11-22 17:54:49",
              "duration": 3600,
              "direction": "outbound",
              "caller": "102",
              "callee": "+34676896561",
              "owner": null,
              "disposition": "answered",
              "numRecordings": 1,
              "id": 2
          }
      ]
      """

Feature: Retrieve users
  In order to manage users
  As a client admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the Users Cdr json list
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "users_cdrs"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      [
          {
              "startTime": "2018-11-22 17:54:49",
              "endTime": "2018-11-22 17:54:54",
              "duration": 4.539,
              "direction": "outbound",
              "caller": "102",
              "callee": "+34676896561",
              "id": 1,
              "user": 1,
              "friend": null
          },
          {
              "startTime": "2018-11-23 17:54:49",
              "endTime": "2018-11-23 18:54:49",
              "duration": 3600,
              "direction": "outbound",
              "caller": "102",
              "callee": "+34676896561",
              "id": 2,
              "user": 1,
              "friend": null
          }
      ]
      """

  Scenario: Retrieve a specific Users Cdr element
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "users_cdrs/1"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
      """
      {
          "startTime": "2018-11-22 17:54:49",
          "endTime": "2018-11-22 17:54:54",
          "duration": 4.539,
          "direction": "outbound",
          "caller": "102",
          "callee": "+34676896561",
          "diversion": null,
          "referee": null,
          "referrer": null,
          "callid": "9297bdde-309cd48f@10.10.1.123",
          "callidHash": "517fa1eb",
          "xcallid": null,
          "id": 1,
          "user": "~",
          "friend": null
      }
      """

Feature: Retrieve users cdrs
  In order to manage users cdrs
  As a brand admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the users cdrs json list
    Given I add Brand Authorization header
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
              "id": 1
          },
          {
              "startTime": "2018-11-23 17:54:49",
              "endTime": "2018-11-23 18:54:49",
              "duration": 3600,
              "direction": "outbound",
              "caller": "102",
              "callee": "+34676896561",
              "id": 2
          }
      ]
    """

  Scenario: Retrieve certain administrator json
    Given I add Brand Authorization header
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
          "company": "~",
          "friend": null,
          "residentialDevice": null,
          "retailAccount": null
      }
    """

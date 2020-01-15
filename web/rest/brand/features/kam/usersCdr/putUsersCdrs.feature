Feature: Update users cdrs
  In order to manage users cdrs
  As a brand admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update an users cdrs
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/users_cdrs/1" with body:
    """
      {
          "startTime": "2019-11-22 17:54:49",
          "endTime": "2019-11-22 17:54:54",
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
          "company": 1,
          "friend": null,
          "residentialDevice": null,
          "retailAccount": null
      }
    """
    Then the response status code should be 405

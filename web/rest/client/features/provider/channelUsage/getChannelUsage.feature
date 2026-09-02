Feature: Retrieve channel usages
  In order to check my channel usage historics
  As a client admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the channel usages json list
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "channel_usages"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      [
          {
              "timestamp": "2026-01-02 09:15:00",
              "peak": 2,
              "avgUsage": 0.75,
              "maxCallsCompany": 10,
              "blockedByCompanyLimit": 0,
              "id": 4
          },
          {
              "timestamp": "2026-01-02 09:10:00",
              "peak": 4,
              "avgUsage": 3.5,
              "maxCallsCompany": 10,
              "blockedByCompanyLimit": 2,
              "id": 3
          },
          {
              "timestamp": "2026-01-02 09:05:00",
              "peak": 5,
              "avgUsage": 2.25,
              "maxCallsCompany": 10,
              "blockedByCompanyLimit": 0,
              "id": 2
          },
          {
              "timestamp": "2026-01-02 09:00:00",
              "peak": 3,
              "avgUsage": 1.5,
              "maxCallsCompany": 10,
              "blockedByCompanyLimit": 0,
              "id": 1
          }
      ]
      """

  Scenario: Retrieve the channel usages json list filtered by timestamp range
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "channel_usages?timestamp[after]=2026-01-02 09:05:00&timestamp[before]=2026-01-02 09:10:00&_order[timestamp]=ASC"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      [
          {
              "timestamp": "2026-01-02 09:05:00",
              "peak": 5,
              "avgUsage": 2.25,
              "maxCallsCompany": 10,
              "blockedByCompanyLimit": 0,
              "id": 2
          },
          {
              "timestamp": "2026-01-02 09:10:00",
              "peak": 4,
              "avgUsage": 3.5,
              "maxCallsCompany": 10,
              "blockedByCompanyLimit": 2,
              "id": 3
          }
      ]
      """

  Scenario: Retrieve only own company channel usages (Retail Company)
    Given I add Retail Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "channel_usages"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      [
          {
              "timestamp": "2026-01-02 09:00:00",
              "peak": 1,
              "avgUsage": 0.5,
              "maxCallsCompany": 5,
              "blockedByCompanyLimit": 0,
              "id": 5
          }
      ]
      """

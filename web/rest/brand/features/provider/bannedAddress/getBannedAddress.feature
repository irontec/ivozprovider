Feature: Manage banned addresses
  In order to manage banned addresses
  as a super admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the banned address json list
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "banned_addresses"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
      [
          {
              "ip": "8.8.8.8",
              "lastTimeBanned": "2020-03-10 11:00:00",
              "id": 2,
              "company": 1
          },
          {
              "ip": "8.8.8.9",
              "lastTimeBanned": "2020-03-10 11:00:00",
              "id": 3,
              "company": 1
          }
      ]
    """

  Scenario: Retrieve certain banned address json
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "banned_addresses/2"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
    """
      {
          "ip": "8.8.8.8",
          "blocker": "ipfilter",
          "aor": "aor",
          "description": null,
          "lastTimeBanned": "2020-03-10 11:00:00",
          "id": 2,
          "company": "~"
      }
    """

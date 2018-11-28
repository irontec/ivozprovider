Feature: Retrieve calendars
  In order to manage calendars
  As an super admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the calendars json list
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "calendars"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
      [
          {
              "name": "testCalendar",
              "id": 1
          },
          {
              "name": "testCalendar2",
              "id": 2
          }
      ]
    """

  Scenario: Retrieve certain calendar json
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "calendars/1"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
    """
      {
          "name": "testCalendar",
          "id": 1,
          "company": "~"
      }
    """

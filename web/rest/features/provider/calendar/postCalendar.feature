Feature: Create calendars
  In order to manage calendars
  As an super admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create an calendars
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "calendars" with body:
    """
      {
          "name": "testNewCalendar",
          "company": 1
      }
    """
    Then the response status code should be 201
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be equal to:
    """
      {
          "name": "testNewCalendar",
          "id": 3
      }
    """

  Scenario: Retrieve created calendars
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "calendars/3"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
    """
      {
          "name": "testNewCalendar",
          "id": 3,
          "company": "~"
      }
    """

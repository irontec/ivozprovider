Feature: Update calendars
  In order to manage calendars
  As an super admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update an calendars
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/calendars/1" with body:
    """
      {
          "name": "updatedCalendar",
          "id": 1,
          "company": 2
      }
    """
    Then the response status code should be 200
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be like:
    """
      {
          "name": "updatedCalendar",
          "id": 1,
          "company": "~"
      }
    """

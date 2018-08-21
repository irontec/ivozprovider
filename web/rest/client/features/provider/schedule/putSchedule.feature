Feature: Update schedules
  In order to manage schedules
  As an super admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update a schedule
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/schedules/1" with body:
    """
      {
          "name": "updatedSchedule",
          "timeIn": "08:00:01",
          "timeout": "16:00:01",
          "monday": false,
          "tuesday": true,
          "wednesday": true,
          "thursday": true,
          "friday": true,
          "saturday": false,
          "sunday": false,
          "company": 2
      }
    """
    Then the response status code should be 200
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be like:
    """
      {
          "name": "updatedSchedule",
          "timeIn": "08:00:01",
          "timeout": "16:00:01",
          "monday": false,
          "tuesday": true,
          "wednesday": true,
          "thursday": true,
          "friday": true,
          "saturday": false,
          "sunday": false,
          "id": 1,
          "company": "~"
      }
    """

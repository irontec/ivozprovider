Feature: Create schedules
  In order to manage schedules
  As an super admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create a schedule
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/schedules" with body:
    """
      {
          "name": "schedule 3",
          "timeIn": "09:00:00",
          "timeout": "17:00:00",
          "monday": true,
          "tuesday": true,
          "wednesday": true,
          "thursday": true,
          "friday": true,
          "saturday": false,
          "sunday": false,
          "company": 2
      }
    """
    Then the response status code should be 201
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be equal to:
    """
      {
          "name": "schedule 3",
          "timeIn": "09:00:00",
          "timeout": "17:00:00",
          "monday": true,
          "tuesday": true,
          "wednesday": true,
          "thursday": true,
          "friday": true,
          "saturday": false,
          "sunday": false,
          "id": 3
      }
    """

  Scenario: Retrieve created schedule
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "/schedules/3"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
    """
      {
          "name": "schedule 3",
          "timeIn": "09:00:00",
          "timeout": "17:00:00",
          "monday": true,
          "tuesday": true,
          "wednesday": true,
          "thursday": true,
          "friday": true,
          "saturday": false,
          "sunday": false,
          "id": 3,
          "company": "~"
      }
    """

Feature: Retrieve schedules
  In order to manage schedules
  As an super admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the schedules json list
    Given I add Company Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "schedules"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      [
          {
              "name": "aSchedule",
              "timeIn": "08:00:00",
              "timeout": "16:00:00",
              "monday": true,
              "tuesday": true,
              "wednesday": true,
              "thursday": true,
              "friday": true,
              "saturday": false,
              "sunday": false,
              "id": 1
          },
          {
              "name": "anotherSchedule",
              "timeIn": "08:00:00",
              "timeout": "16:00:00",
              "monday": true,
              "tuesday": true,
              "wednesday": true,
              "thursday": true,
              "friday": true,
              "saturday": false,
              "sunday": false,
              "id": 2
          }
      ]
    """

  Scenario: Retrieve certain schedule json
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "schedules/1"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
    """
      {
          "name": "aSchedule",
          "timeIn": "08:00:00",
          "timeout": "16:00:00",
          "monday": true,
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

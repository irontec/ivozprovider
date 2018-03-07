Feature: Retrieve holiday dates
  In order to manage holiday dates
  As an super admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the holiday dates json list
    Given I add Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "holiday_dates"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      [
          {
              "name": "Name",
              "eventDate": "2021-12-21 00:00:00",
              "id": 1
          }
      ]
    """

  Scenario: Retrieve certain holiday date json
    Given I add Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "holiday_dates/1"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      {
          "name": "Name",
          "eventDate": "2021-12-21 00:00:00",
          "id": 1,
          "calendar": {
              "name": "testCalendar",
              "id": 1,
              "company": 1
          },
          "locution": null
      }
    """

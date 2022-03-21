Feature: Update holiday dates
  In order to manage holiday dates
  As a client admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update a holiday date
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/holiday_dates/1" with body:
    """
      {
          "name": "UpdatedName",
          "eventDate": "2021-12-22",
          "calendar": 2,
          "locution": 1
      }
    """
    Then the response status code should be 200
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be equal to:
    """
      {
          "name": "UpdatedName",
          "eventDate": "2021-12-22",
          "wholeDayEvent": true,
          "timeIn": null,
          "timeOut": null,
          "routeType": null,
          "numberValue": null,
          "id": 1,
          "calendar": 2,
          "locution": 1,
          "extension": null,
          "voicemail": null,
          "numberCountry": null
      }
    """

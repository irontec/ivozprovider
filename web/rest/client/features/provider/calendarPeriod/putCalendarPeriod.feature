Feature: Update calendar periods
  In order to manage calendar periods
  As a client admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update an calendar periods
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/calendar_periods/1" with body:
    """
      {
          "startDate": "2019-05-01",
          "endDate": "2019-06-01",
          "routeType": "extension",
          "numberValue": null,
          "calendar": 1,
          "locution": null,
          "extension": 1,
          "voicemail": null,
          "numberCountry": null,
          "scheduleIds": [
              2
          ]
      }
    """
    Then the response status code should be 200
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be equal to:
    """
      {
          "startDate": "2019-05-01",
          "endDate": "2019-06-01",
          "routeType": "extension",
          "numberValue": null,
          "id": 1,
          "calendar": 1,
          "locution": null,
          "extension": 1,
          "voicemail": null,
          "numberCountry": null,
          "scheduleIds": [
              2
          ]
      }
    """

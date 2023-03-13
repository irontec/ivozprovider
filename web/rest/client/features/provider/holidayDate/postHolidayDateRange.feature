Feature: Create holiday dates range
  In order to manage holiday dates
  As a client admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create a holiday date range
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/holiday_dates_range" with body:
      """
      {
        "name": "Mervin Schultz",
        "startDate": "2023/02/01",
        "endDate": "2023/02/10",
        "calendar": 1,
        "wholeDayEvent": 0,
        "timeIn": "02:00:00",
        "timeOut": "03:00:00",
        "locution": null,
        "routeType": null
      }
      """
     Then the response status code should be 201

  Scenario: Retrieve created holiday date range
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "holiday_dates?name[exact]=Mervin Schultz"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      [
          {
              "name": "Mervin Schultz",
              "eventDate": "2023-02-01",
              "wholeDayEvent": false,
              "timeIn": null,
              "timeOut": null,
              "routeType": null,
              "numberValue": null,
              "id": 3,
              "calendar": 1,
              "locution": null,
              "extension": null,
              "voicemail": null,
              "numberCountry": null
          },
          {
              "name": "Mervin Schultz",
              "eventDate": "2023-02-02",
              "wholeDayEvent": false,
              "timeIn": null,
              "timeOut": null,
              "routeType": null,
              "numberValue": null,
              "id": 4,
              "calendar": 1,
              "locution": null,
              "extension": null,
              "voicemail": null,
              "numberCountry": null
          },
          {
              "name": "Mervin Schultz",
              "eventDate": "2023-02-03",
              "wholeDayEvent": false,
              "timeIn": null,
              "timeOut": null,
              "routeType": null,
              "numberValue": null,
              "id": 5,
              "calendar": 1,
              "locution": null,
              "extension": null,
              "voicemail": null,
              "numberCountry": null
          },
          {
              "name": "Mervin Schultz",
              "eventDate": "2023-02-04",
              "wholeDayEvent": false,
              "timeIn": null,
              "timeOut": null,
              "routeType": null,
              "numberValue": null,
              "id": 6,
              "calendar": 1,
              "locution": null,
              "extension": null,
              "voicemail": null,
              "numberCountry": null
          },
          {
              "name": "Mervin Schultz",
              "eventDate": "2023-02-05",
              "wholeDayEvent": false,
              "timeIn": null,
              "timeOut": null,
              "routeType": null,
              "numberValue": null,
              "id": 7,
              "calendar": 1,
              "locution": null,
              "extension": null,
              "voicemail": null,
              "numberCountry": null
          },
          {
              "name": "Mervin Schultz",
              "eventDate": "2023-02-06",
              "wholeDayEvent": false,
              "timeIn": null,
              "timeOut": null,
              "routeType": null,
              "numberValue": null,
              "id": 8,
              "calendar": 1,
              "locution": null,
              "extension": null,
              "voicemail": null,
              "numberCountry": null
          },
          {
              "name": "Mervin Schultz",
              "eventDate": "2023-02-07",
              "wholeDayEvent": false,
              "timeIn": null,
              "timeOut": null,
              "routeType": null,
              "numberValue": null,
              "id": 9,
              "calendar": 1,
              "locution": null,
              "extension": null,
              "voicemail": null,
              "numberCountry": null
          },
          {
              "name": "Mervin Schultz",
              "eventDate": "2023-02-08",
              "wholeDayEvent": false,
              "timeIn": null,
              "timeOut": null,
              "routeType": null,
              "numberValue": null,
              "id": 10,
              "calendar": 1,
              "locution": null,
              "extension": null,
              "voicemail": null,
              "numberCountry": null
          },
          {
              "name": "Mervin Schultz",
              "eventDate": "2023-02-09",
              "wholeDayEvent": false,
              "timeIn": null,
              "timeOut": null,
              "routeType": null,
              "numberValue": null,
              "id": 11,
              "calendar": 1,
              "locution": null,
              "extension": null,
              "voicemail": null,
              "numberCountry": null
          },
          {
              "name": "Mervin Schultz",
              "eventDate": "2023-02-10",
              "wholeDayEvent": false,
              "timeIn": null,
              "timeOut": null,
              "routeType": null,
              "numberValue": null,
              "id": 12,
              "calendar": 1,
              "locution": null,
              "extension": null,
              "voicemail": null,
              "numberCountry": null
          }
      ]
      """

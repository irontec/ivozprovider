Feature: Import holiday dates
  In order to manage holiday dates
  As a client admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Holiday Dates mass import
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "multipart/form-data; boundary=------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" multipart request to "/holiday_dates/mass_import" with body:
        """
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="calendar"

1
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="csv"; filename="massImport.csv"
Content-Type: text/csv

"Christmas eve","2018-12-24"
"New year's day","2019-01-01"
"New year's day new","2020-01-01"
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8--

    """
    Then the response status code should be 201
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      {
          "success": true,
          "errorMsg": "[]",
          "failed": 0
      }
    """

  Scenario: Retrieve created holiday dates json list
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "holiday_dates"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      [
          {
              "name": "Christmas eve",
              "eventDate": "2018-12-24",
              "wholeDayEvent": true,
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
              "name": "New year's day",
              "eventDate": "2019-01-01",
              "wholeDayEvent": true,
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
              "name": "New year's day new",
              "eventDate": "2020-01-01",
              "wholeDayEvent": true,
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
              "name": "Name",
              "eventDate": "2021-12-21",
              "wholeDayEvent": true,
              "timeIn": null,
              "timeOut": null,
              "routeType": null,
              "numberValue": null,
              "id": 1,
              "calendar": 1,
              "locution": null,
              "extension": null,
              "voicemail": null,
              "numberCountry": null
          },
          {
              "name": "timeRangeEvent",
              "eventDate": "2021-12-21",
              "wholeDayEvent": false,
              "timeIn": "00:00:00",
              "timeOut": "10:00:00",
              "routeType": null,
              "numberValue": null,
              "id": 2,
              "calendar": 1,
              "locution": null,
              "extension": null,
              "voicemail": null,
              "numberCountry": null
          }
      ]
      """

  @createSchema
  Scenario: Holiday Dates mass import with import params
    Given I add Company Authorization header
    When I add "Content-Type" header equal to "multipart/form-data; boundary=------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8"
    And I add "Accept" header equal to "application/json"
    And I send a "POST" multipart request to "/holiday_dates/mass_import" with body:
        """
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="calendar"

1
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="importerArguments"

{"escape":"\\","columns":["name","eventDate"],"delimiter":";","enclosure":"'","ignoreFirst":true}
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="csv"; filename="massImport.csv"
Content-Type: text/csv

'Christmas eve';'2018-12-24'
'New year\'s day';'2019-01-01'
'New year\'s day new';'2020-01-01'
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8--

    """
    Then the response status code should be 201
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      {
          "success": true,
          "errorMsg": "[]",
          "failed": 0
      }
    """

  Scenario: Retrieve created with import params holiday dates json list
    Given I add Company Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "holiday_dates"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
    [
          {
              "name": "New year\\'s day",
              "eventDate": "2019-01-01",
              "wholeDayEvent": true,
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
              "name": "New year\\'s day new",
              "eventDate": "2020-01-01",
              "wholeDayEvent": true,
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
              "name": "Name",
              "eventDate": "2021-12-21",
              "wholeDayEvent": true,
              "timeIn": null,
              "timeOut": null,
              "routeType": null,
              "numberValue": null,
              "id": 1,
              "calendar": 1,
              "locution": null,
              "extension": null,
              "voicemail": null,
              "numberCountry": null
          },
          {
              "name": "timeRangeEvent",
              "eventDate": "2021-12-21",
              "wholeDayEvent": false,
              "timeIn": "00:00:00",
              "timeOut": "10:00:00",
              "routeType": null,
              "numberValue": null,
              "id": 2,
              "calendar": 1,
              "locution": null,
              "extension": null,
              "voicemail": null,
              "numberCountry": null
          }
      ]
    """

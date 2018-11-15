Feature: Create holiday dates
  In order to manage holiday dates
  As an super admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create a holiday date
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/holiday_dates" with body:
    """
      {
          "name": "New",
          "eventDate": "2017-12-21",
          "calendar": 1,
          "locution": 1
      }
    """
    Then the response status code should be 201
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be equal to:
    """
      {
          "name": "New",
          "eventDate": "2017-12-21",
          "id": 2
      }
    """

  Scenario: Retrieve created holiday date
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "holiday_dates/2"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
      {
          "name": "New",
          "eventDate": "2017-12-21",
          "id": 2,
          "calendar": {
              "name": "testCalendar",
              "id": 1,
              "company": 1
          },
          "locution": {
              "name": "testLocution",
              "status": null,
              "id": 1,
              "encodedFile": {
                  "fileSize": 1,
                  "mimeType": "audio/x-wav; charset=binary",
                  "baseName": "locution.wav"
              },
              "originalFile": {
                  "fileSize": 1,
                  "mimeType": "audio/mpeg; charset=binary",
                  "baseName": "locution.mp3"
              },
              "company": 1
          }
      }
    """

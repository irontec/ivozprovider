Feature: Create extensions
  In order to manage extensions
  As a client admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create an extension
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/extensions" with body:
      """
      {
          "number": "111",
          "routeType": "user",
          "numberValue": null,
          "friendValue": null,
          "ivr": null,
          "huntGroup": null,
          "conferenceRoom": null,
          "user": 1,
          "queue": null,
          "conditionalRoute": null,
          "numberCountry": null,
          "voicemail": null
      }
      """
     Then the response status code should be 201
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      {
          "number": "111",
          "routeType": "user",
          "numberValue": null,
          "friendValue": null,
          "id": 8,
          "ivr": null,
          "huntGroup": null,
          "conferenceRoom": null,
          "user": 1,
          "queue": null,
          "conditionalRoute": null,
          "numberCountry": null,
          "voicemail": null,
          "locution": null
      }
      """

  @createSchema
  Scenario: Create an extension with locution route type and no locution selected
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/extensions" with body:
      """
      {
          "number": "113",
          "routeType": "locution",
          "numberValue": null,
          "friendValue": null,
          "ivr": null,
          "huntGroup": null,
          "conferenceRoom": null,
          "user": null,
          "queue": null,
          "conditionalRoute": null,
          "numberCountry": null,
          "voicemail": null,
          "locution": null
      }
      """
     Then the response status code should be 201
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      {
          "number": "113",
          "routeType": "locution",
          "numberValue": null,
          "friendValue": null,
          "id": 8,
          "ivr": null,
          "huntGroup": null,
          "conferenceRoom": null,
          "user": null,
          "queue": null,
          "conditionalRoute": null,
          "numberCountry": null,
          "voicemail": null,
          "locution": null
      }
      """

  @createSchema
  Scenario: Create an extension with locution route type
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/extensions" with body:
      """
      {
          "number": "112",
          "routeType": "locution",
          "numberValue": null,
          "friendValue": null,
          "ivr": null,
          "huntGroup": null,
          "conferenceRoom": null,
          "user": null,
          "queue": null,
          "conditionalRoute": null,
          "numberCountry": null,
          "voicemail": null,
          "locution": 1
      }
      """
     Then the response status code should be 201
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      {
          "number": "112",
          "routeType": "locution",
          "numberValue": null,
          "friendValue": null,
          "id": 8,
          "ivr": null,
          "huntGroup": null,
          "conferenceRoom": null,
          "user": null,
          "queue": null,
          "conditionalRoute": null,
          "numberCountry": null,
          "voicemail": null,
          "locution": 1
      }
      """

  Scenario: Retrieve created extension
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "extensions/6"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
      """
      {
          "number": "999",
          "routeType": "locution",
          "numberValue": null,
          "friendValue": null,
          "id": 6,
          "ivr": null,
          "huntGroup": null,
          "conferenceRoom": null,
          "user": null,
          "queue": null,
          "conditionalRoute": null,
          "numberCountry": null,
          "voicemail": null,
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
              }
          }
      }
      """

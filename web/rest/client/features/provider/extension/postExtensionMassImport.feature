Feature: Import extensions
  In order to manage extensions
  As a client admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Extensions mass import
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "multipart/form-data; boundary=------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" multipart request to "/extensions/mass_import" with body:
        """
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8
Content-Disposition: form-data; name="csv"; filename="massImport.csv"
Content-Type: text/csv

Extension,CountryPrefix,Number,CountryCode
200,+34,944048184,ES
201,+34,944048185,ES
202,+34,944048186
203,+1,944048187
204,+1,944048188,US
------IvozProviderFormBoundaryFUBrG71LG0e8DuZ8--

    """
    Then the response status code should be 201
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      {
          "success": true,
          "errorMsg": "",
          "failed": 0
      }
    """

  Scenario: Retrieve created extensions json list
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "extensions"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      [
          {
              "number": "101",
              "routeType": "user",
              "numberValue": null,
              "friendValue": null,
              "id": 1,
              "ivr": null,
              "huntGroup": null,
              "conferenceRoom": null,
              "user": 1,
              "queue": null,
              "conditionalRoute": null,
              "numberCountry": null,
              "voicemail": null,
              "locution": null
          },
          {
              "number": "102",
              "routeType": "user",
              "numberValue": null,
              "friendValue": null,
              "id": 2,
              "ivr": null,
              "huntGroup": null,
              "conferenceRoom": null,
              "user": 2,
              "queue": null,
              "conditionalRoute": null,
              "numberCountry": null,
              "voicemail": null,
              "locution": null
          },
          {
              "number": "12346",
              "routeType": "number",
              "numberValue": "946006060",
              "friendValue": null,
              "id": 3,
              "ivr": null,
              "huntGroup": null,
              "conferenceRoom": null,
              "user": null,
              "queue": null,
              "conditionalRoute": null,
              "numberCountry": 68,
              "voicemail": null,
              "locution": null
          },
          {
              "number": "200",
              "routeType": "number",
              "numberValue": "944048184",
              "friendValue": null,
              "id": 8,
              "ivr": null,
              "huntGroup": null,
              "conferenceRoom": null,
              "user": null,
              "queue": null,
              "conditionalRoute": null,
              "numberCountry": 68,
              "voicemail": null,
              "locution": null
          },
          {
              "number": "201",
              "routeType": "number",
              "numberValue": "944048185",
              "friendValue": null,
              "id": 9,
              "ivr": null,
              "huntGroup": null,
              "conferenceRoom": null,
              "user": null,
              "queue": null,
              "conditionalRoute": null,
              "numberCountry": 68,
              "voicemail": null,
              "locution": null
          },
          {
              "number": "202",
              "routeType": "number",
              "numberValue": "944048186",
              "friendValue": null,
              "id": 10,
              "ivr": null,
              "huntGroup": null,
              "conferenceRoom": null,
              "user": null,
              "queue": null,
              "conditionalRoute": null,
              "numberCountry": 68,
              "voicemail": null,
              "locution": null
          },
          {
              "number": "203",
              "routeType": "number",
              "numberValue": "944048187",
              "friendValue": null,
              "id": 11,
              "ivr": null,
              "huntGroup": null,
              "conferenceRoom": null,
              "user": null,
              "queue": null,
              "conditionalRoute": null,
              "numberCountry": 38,
              "voicemail": null,
              "locution": null
          },
          {
              "number": "204",
              "routeType": "number",
              "numberValue": "944048188",
              "friendValue": null,
              "id": 12,
              "ivr": null,
              "huntGroup": null,
              "conferenceRoom": null,
              "user": null,
              "queue": null,
              "conditionalRoute": null,
              "numberCountry": 233,
              "voicemail": null,
              "locution": null
          },
          {
              "number": "987",
              "routeType": null,
              "numberValue": null,
              "friendValue": null,
              "id": 4,
              "ivr": null,
              "huntGroup": null,
              "conferenceRoom": null,
              "user": null,
              "queue": null,
              "conditionalRoute": null,
              "numberCountry": null,
              "voicemail": null,
              "locution": null
          },
          {
              "number": "988",
              "routeType": "user",
              "numberValue": null,
              "friendValue": null,
              "id": 5,
              "ivr": null,
              "huntGroup": null,
              "conferenceRoom": null,
              "user": 3,
              "queue": null,
              "conditionalRoute": null,
              "numberCountry": null,
              "voicemail": null,
              "locution": null
          },
          {
              "number": "998",
              "routeType": "locution",
              "numberValue": null,
              "friendValue": null,
              "id": 7,
              "ivr": null,
              "huntGroup": null,
              "conferenceRoom": null,
              "user": null,
              "queue": null,
              "conditionalRoute": null,
              "numberCountry": null,
              "voicemail": null,
              "locution": null
          },
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
              "locution": 1
          }
      ]
      """
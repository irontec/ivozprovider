Feature: Update conditional routes
  In order to manage conditional routes
  As a client admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update an conditional routes
    Given I add Company Authorization header
    When I add "Content-Type" header equal to "application/json"
    And I add "Accept" header equal to "application/json"
    And I send a "PUT" request to "/conditional_routes/1" with body:
    """
      {
          "name": "testUpdate",
          "routetype": "number",
          "numbervalue": "946002021",
          "friendvalue": "",
          "id": 1,
          "ivr": null,
          "huntGroup": null,
          "voicemailUser": null,
          "user": null,
          "queue": null,
          "locution": null,
          "conferenceRoom": null,
          "extension": null,
          "numberCountry": 68
      }
    """
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be like:
    """
      {
          "name": "testUpdate",
          "routetype": "number",
          "numbervalue": "946002021",
          "friendvalue": null,
          "id": 1,
          "ivr": null,
          "huntGroup": null,
          "voicemailUser": null,
          "user": null,
          "queue": null,
          "locution": null,
          "conferenceRoom": null,
          "extension": null,
          "numberCountry": {
              "code": "ES",
              "countryCode": "+34",
              "id": 68,
              "name": {
                  "en": "Spain",
                  "es": "España",
                  "ca": "España"
              },
              "zone": {
                  "en": "Europe",
                  "es": "Europa",
                  "ca": "Europa"
              }
          }
      }
    """

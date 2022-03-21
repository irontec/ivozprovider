Feature: Update IVR entries
  In order to manage IVR entries
  As a client admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update a IVR entry
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/ivr_entries/1" with body:
    """
      {
          "entry": "test",
          "routeType": "voicemail",
          "numberValue": null,
          "ivr": 1,
          "welcomeLocution": 1,
          "extension": null,
          "voicemail": 1,
          "conditionalRoute": null,
          "numberCountry": 2
      }
    """
    Then the response status code should be 200
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be equal to:
    """
     {
          "entry": "test",
          "routeType": "voicemail",
          "numberValue": null,
          "id": 1,
          "ivr": 1,
          "welcomeLocution": 1,
          "extension": null,
          "voicemail": 1,
          "conditionalRoute": null,
          "numberCountry": null
      }
    """

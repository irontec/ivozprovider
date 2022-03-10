Feature: Create conditional routes
  In order to manage conditional routes
  As a client admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create an conditional routes
    Given I add Company Authorization header
    When I add "Content-Type" header equal to "application/json"
    And I add "Accept" header equal to "application/json"
    And I send a "POST" request to "/conditional_routes" with body:
    """
      {
          "name": "testPost",
          "routetype": "user",
          "numberValue": null,
          "friendvalue": "",
          "id": 1,
          "ivr": null,
          "huntGroup": null,
          "voicemail": null,
          "user": 2,
          "queue": null,
          "locution": null,
          "conferenceRoom": null,
          "extension": null,
          "numberCountry": null
      }
    """
    Then the response status code should be 201
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      {
          "name": "testPost",
          "routetype": "user",
          "numbervalue": null,
          "friendvalue": null,
          "id": 3,
          "ivr": null,
          "huntGroup": null,
          "voicemail": null,
          "user": 2,
          "queue": null,
          "locution": null,
          "conferenceRoom": null,
          "extension": null,
          "numberCountry": null
      }
    """

  Scenario: Retrieve created conditional routes
    Given I add Company Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "conditional_routes/3"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be like:
    """
       {
          "name": "testPost",
          "routetype": "user",
          "numbervalue": null,
          "friendvalue": null,
          "id": 3,
          "ivr": null,
          "huntGroup": null,
          "voicemail": null,
          "user": "~",
          "queue": null,
          "locution": null,
          "conferenceRoom": null,
          "extension": null,
          "numberCountry": null
      }
    """

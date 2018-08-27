Feature: Retrieve extensions
  In order to manage extensions
  As an super admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the extensions json list
    Given I add Authorization header
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
              "id": 1
          },
          {
              "number": "102",
              "id": 2
          },
          {
              "number": "12346",
              "routeType": "number",
              "id": 3
          }
      ]
    """

  Scenario: Retrieve certain extension json
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "extensions/1"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
    """
      {
          "number": "101",
          "routeType": "user",
          "numberValue": null,
          "friendValue": null,
          "id": 1,
          "company": "~",
          "ivr": null,
          "huntGroup": null,
          "conferenceRoom": null,
          "user": "~",
          "queue": null,
          "conditionalRoute": null,
          "numberCountry": null
      }
    """

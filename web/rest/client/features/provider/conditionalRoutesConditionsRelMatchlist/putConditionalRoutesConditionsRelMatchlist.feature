Feature: Update conditional routes conditions rel matchlists
  In order to manage conditional routes conditions rel matchlists
  As an super admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update an conditional routes conditions rel matchlist
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/conditional_routes_conditions_rel_matchlists/1" with body:
    """
      {
          "id": 1,
          "condition": 1,
          "matchlist": 2
      }
    """
    Then the response status code should be 200
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be equal to:
    """
      {
          "id": 1,
          "condition": {
              "priority": 1,
              "routeType": null,
              "numberValue": null,
              "friendValue": null,
              "id": 1,
              "conditionalRoute": 1,
              "ivr": null,
              "huntGroup": null,
              "voicemailUser": null,
              "user": null,
              "queue": null,
              "locution": null,
              "conferenceRoom": null,
              "extension": null,
              "numberCountry": null
          },
          "matchlist": {
              "name": "testMatchlist2",
              "id": 2,
              "brand": null,
              "company": 1
          }
      }
    """

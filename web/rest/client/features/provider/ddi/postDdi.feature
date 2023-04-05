Feature: Create Ddis
  In order to manage Ddis
  As a client admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create a Ddi
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/ddis" with body:
      """
      {
          "ddi": "1234",
          "ddie164": "+341234",
          "description": "Description for DDI 1234",
          "recordCalls": "none",
          "displayName": "",
          "routeType": "user",
          "friendValue": "",
          "conferenceRoom": null,
          "language": null,
          "queue": null,
          "externalCallFilter": null,
          "user": 1,
          "ivr": null,
          "huntGroup": null,
          "fax": null,
          "ddiProvider": null,
          "country": 1,
          "residentialDevice": null,
          "conditionalRoute": null
      }
      """
     Then the response status code should be 405

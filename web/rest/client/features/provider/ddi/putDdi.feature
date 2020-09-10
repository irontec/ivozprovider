Feature: Update Ddis
  In order to manage Ddis
  As a client admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update a Ddi
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/ddis/1" with body:
    """
      {
          "ddi": "1234",
          "recordCalls": "none",
          "displayName": "",
          "routeType": null,
          "billInboundCalls": false,
          "friendValue": "",
          "conferenceRoom": null,
          "language": null,
          "queue": null,
          "externalCallFilter": null,
          "user": null,
          "ivr": null,
          "huntGroup": null,
          "fax": null,
          "ddiProvider": 1,
          "country": 68,
          "residentialDevice": null,
          "conditionalRoute": null
      }
    """
    Then the response status code should be 200
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be equal to:
    """
      {
          "ddi": "1234",
          "recordCalls": "none",
          "displayName": "",
          "routeType": null,
          "friendValue": "",
          "id": 1,
          "conferenceRoom": null,
          "language": null,
          "queue": null,
          "externalCallFilter": null,
          "user": null,
          "ivr": null,
          "huntGroup": null,
          "fax": null,
          "country": 68,
          "residentialDevice": null,
          "conditionalRoute": null,
          "retailAccount": null
      }
    """

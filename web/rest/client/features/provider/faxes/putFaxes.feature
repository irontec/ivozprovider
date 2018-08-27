Feature: Update faxes
  In order to manage faxes
  As an super admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update a fax
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/faxes/1" with body:
    """
      {
          "name": "Updated Fax",
          "email": "something@irontec.com",
          "sendByEmail": true,
          "company": 2,
          "outgoingDdi": 1
      }
    """
    Then the response status code should be 200
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be like:
    """
      {
          "name": "Updated Fax",
          "email": "something@irontec.com",
          "sendByEmail": true,
          "id": 1,
          "company": "~",
          "outgoingDdi": {
              "ddi": "123",
              "ddie164": "+34123",
              "recordCalls": "none",
              "displayName": "",
              "routeType": null,
              "billInboundCalls": false,
              "friendValue": "",
              "id": 1,
              "company": 1,
              "brand": 1,
              "conferenceRoom": null,
              "language": null,
              "queue": null,
              "externalCallFilter": null,
              "user": null,
              "ivr": null,
              "huntGroup": null,
              "fax": null,
              "ddiProvider": 1,
              "country": 1,
              "residentialDevice": null,
              "conditionalRoute": null
          }
      }
    """

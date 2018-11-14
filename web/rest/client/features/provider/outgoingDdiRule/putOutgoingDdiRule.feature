Feature: Update outgoing ddi rules
  In order to manage outgoing ddi rules
  As an super admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update an outgoing ddi rules
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/outgoing_ddi_rules/1" with body:
    """
      {
          "name": "updatedRule",
          "defaultAction": "force",
          "company": 2,
          "forcedDdi": 1
      }
    """
    Then the response status code should be 200
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be like:
    """
      {
          "name": "updatedRule",
          "defaultAction": "force",
          "id": 1,
          "company": "~",
          "forcedDdi": {
              "ddi": "123",
              "ddie164": "+34123",
              "recordCalls": "none",
              "displayName": "",
              "routeType": null,
              "billInboundCalls": false,
              "friendValue": "",
              "id": 1,
              "company": 1,
              "conferenceRoom": null,
              "language": null,
              "queue": null,
              "externalCallFilter": null,
              "user": null,
              "ivr": null,
              "huntGroup": null,
              "fax": null,
              "country": 1,
              "residentialDevice": null,
              "conditionalRoute": null,
              "retailAccount": null
          }
      }
    """

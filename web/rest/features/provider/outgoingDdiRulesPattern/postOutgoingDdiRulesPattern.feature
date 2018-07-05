Feature: Create outgoing ddi rules patterns
  In order to manage outgoing ddi rules patterns
  As an super admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create an outgoing ddi rules pattern
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/outgoing_ddi_rules_patterns" with body:
    """
      {
          "action": "force",
          "priority": 2,
          "outgoingDdiRule": 1,
          "matchList": 2,
          "forcedDdi": 1
      }
    """
    Then the response status code should be 201
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be equal to:
    """
      {
          "action": "force",
          "priority": 2,
          "id": 2,
          "outgoingDdiRule": {
              "name": "testRule",
              "defaultAction": "keep",
              "id": 1,
              "company": 1,
              "forcedDdi": null
          },
          "matchList": {
              "name": "testMatchlist2",
              "id": 2,
              "brand": null,
              "company": 1
          },
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

  Scenario: Retrieve created outgoing ddi rule pattern
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "outgoing_ddi_rules_patterns/2"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
      {
          "action": "force",
          "priority": 2,
          "id": 2,
          "outgoingDdiRule": {
              "name": "testRule",
              "defaultAction": "keep",
              "id": 1,
              "company": 1,
              "forcedDdi": null
          },
          "matchList": {
              "name": "testMatchlist2",
              "id": 2,
              "brand": null,
              "company": 1
          },
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

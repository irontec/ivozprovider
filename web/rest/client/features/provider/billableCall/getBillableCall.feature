Feature: Retrieve billable calls
  In order to manage billable calls
  As a client admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the billable calls json list
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "billable_calls?_itemsPerPage=5"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
      [
          {
              "callid": "017cc7c8-eb38-4bbd-9318-524a274f7000",
              "startTime": "2019-01-01 09:00:00",
              "duration": 0,
              "caller": "+34633646464",
              "callee": "+34633656565",
              "price": 1,
              "endpointType": null,
              "endpointId": null,
              "endpointName": null,
              "direction": "outbound",
              "id": 1,
              "ddi": 1
          },
          {
              "callid": "017cc7c8-eb38-4bbd-9318-524a274f7001",
              "startTime": "2019-01-01 09:00:01",
              "duration": 0,
              "caller": "+34633646464",
              "callee": "+34633656565",
              "price": 1,
              "endpointType": null,
              "endpointId": null,
              "endpointName": null,
              "direction": "outbound",
              "id": 2,
              "ddi": 1
          },
          {
              "callid": "017cc7c8-eb38-4bbd-9318-524a274f7002",
              "startTime": "2019-01-01 09:00:02",
              "duration": 0,
              "caller": "+34633646464",
              "callee": "+34633656565",
              "price": 1,
              "endpointType": null,
              "endpointId": null,
              "endpointName": null,
              "direction": "outbound",
              "id": 3,
              "ddi": 1
          },
          {
              "callid": "017cc7c8-eb38-4bbd-9318-524a274f7003",
              "startTime": "2019-01-01 09:00:03",
              "duration": 0,
              "caller": "+34633646464",
              "callee": "+34633656565",
              "price": 1,
              "endpointType": null,
              "endpointId": null,
              "endpointName": null,
              "direction": "outbound",
              "id": 4,
              "ddi": 1
          },
          {
              "callid": "017cc7c8-eb38-4bbd-9318-524a274f7004",
              "startTime": "2019-01-01 09:00:04",
              "duration": 0,
              "caller": "+34633646464",
              "callee": "+34633656565",
              "price": 1,
              "endpointType": null,
              "endpointId": null,
              "endpointName": null,
              "direction": "outbound",
              "id": 5,
              "ddi": 1
          }
      ]
    """

  Scenario: Retrieve certain billable call json
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "billable_calls/1"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
      {
          "callid": "017cc7c8-eb38-4bbd-9318-524a274f7000",
          "startTime": "2019-01-01 09:00:00",
          "duration": 0,
          "caller": "+34633646464",
          "callee": "+34633656565",
          "price": 1,
          "destinationName": null,
          "ratingPlanName": null,
          "endpointType": null,
          "endpointId": null,
          "endpointName": null,
          "direction": "outbound",
          "id": 1,
          "ddi": {
              "ddi": "123",
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

      }
    """

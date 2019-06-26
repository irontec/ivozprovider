Feature: Retrieve billable calls
  In order to manage billable calls
  As a client admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the billable calls json list
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "billable_calls"
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
              "price": null,
              "endpointType": null,
              "endpointId": null,
              "direction": "outbound",
              "id": 1
          },
          {
              "callid": "017cc7c8-eb38-4bbd-9318-524a274f7001",
              "startTime": "2019-01-01 09:00:01",
              "duration": 0,
              "caller": "+34633646464",
              "callee": "+34633656565",
              "price": null,
              "endpointType": null,
              "endpointId": null,
              "direction": "outbound",
              "id": 2
          },
          {
              "callid": "017cc7c8-eb38-4bbd-9318-524a274f7002",
              "startTime": "2019-01-01 09:00:02",
              "duration": 0,
              "caller": "+34633646464",
              "callee": "+34633656565",
              "price": null,
              "endpointType": null,
              "endpointId": null,
              "direction": "outbound",
              "id": 3
          },
          {
              "callid": "017cc7c8-eb38-4bbd-9318-524a274f7003",
              "startTime": "2019-01-01 09:00:03",
              "duration": 0,
              "caller": "+34633646464",
              "callee": "+34633656565",
              "price": null,
              "endpointType": null,
              "endpointId": null,
              "direction": "outbound",
              "id": 4
          },
          {
              "callid": "017cc7c8-eb38-4bbd-9318-524a274f7004",
              "startTime": "2019-01-01 09:00:04",
              "duration": 0,
              "caller": "+34633646464",
              "callee": "+34633656565",
              "price": null,
              "endpointType": null,
              "endpointId": null,
              "direction": "outbound",
              "id": 5
          },
          {
              "callid": "017cc7c8-eb38-4bbd-9318-524a274f7005",
              "startTime": "2019-01-01 09:00:05",
              "duration": 0,
              "caller": "+34633646464",
              "callee": "+34633656565",
              "price": null,
              "endpointType": null,
              "endpointId": null,
              "direction": "outbound",
              "id": 6
          },
          {
              "callid": "017cc7c8-eb38-4bbd-9318-524a274f7006",
              "startTime": "2019-01-01 09:00:06",
              "duration": 0,
              "caller": "+34633646464",
              "callee": "+34633656565",
              "price": null,
              "endpointType": null,
              "endpointId": null,
              "direction": "outbound",
              "id": 7
          },
          {
              "callid": "017cc7c8-eb38-4bbd-9318-524a274f7007",
              "startTime": "2019-01-01 09:00:07",
              "duration": 0,
              "caller": "+34633646464",
              "callee": "+34633656565",
              "price": null,
              "endpointType": null,
              "endpointId": null,
              "direction": "outbound",
              "id": 8
          },
          {
              "callid": "017cc7c8-eb38-4bbd-9318-524a274f7008",
              "startTime": "2019-01-01 09:00:08",
              "duration": 0,
              "caller": "+34633646464",
              "callee": "+34633656565",
              "price": null,
              "endpointType": null,
              "endpointId": null,
              "direction": "outbound",
              "id": 9
          },
          {
              "callid": "017cc7c8-eb38-4bbd-9318-524a274f7009",
              "startTime": "2019-01-01 09:00:09",
              "duration": 0,
              "caller": "+34633646464",
              "callee": "+34633656565",
              "price": null,
              "endpointType": null,
              "endpointId": null,
              "direction": "outbound",
              "id": 10
          },
          {
              "callid": "017cc7c8-eb38-4bbd-9318-524a274f7010",
              "startTime": "2019-01-01 09:00:10",
              "duration": 0,
              "caller": "+34633646464",
              "callee": "+34633656565",
              "price": null,
              "endpointType": null,
              "endpointId": null,
              "direction": "outbound",
              "id": 11
          },
          {
              "callid": "017cc7c8-eb38-4bbd-9318-524a274f7011",
              "startTime": "2019-01-01 09:00:11",
              "duration": 0,
              "caller": "+34633646464",
              "callee": "+34633656565",
              "price": null,
              "endpointType": null,
              "endpointId": null,
              "direction": "outbound",
              "id": 12
          },
          {
              "callid": "017cc7c8-eb38-4bbd-9318-524a274f7012",
              "startTime": "2019-01-01 09:00:12",
              "duration": 0,
              "caller": "+34633646464",
              "callee": "+34633656565",
              "price": null,
              "endpointType": null,
              "endpointId": null,
              "direction": "outbound",
              "id": 13
          },
          {
              "callid": "017cc7c8-eb38-4bbd-9318-524a274f7013",
              "startTime": "2019-01-01 09:00:13",
              "duration": 0,
              "caller": "+34633646464",
              "callee": "+34633656565",
              "price": null,
              "endpointType": null,
              "endpointId": null,
              "direction": "outbound",
              "id": 14
          },
          {
              "callid": "017cc7c8-eb38-4bbd-9318-524a274f7014",
              "startTime": "2019-01-01 09:00:14",
              "duration": 0,
              "caller": "+34633646464",
              "callee": "+34633656565",
              "price": null,
              "endpointType": null,
              "endpointId": null,
              "direction": "outbound",
              "id": 15
          },
          {
              "callid": "017cc7c8-eb38-4bbd-9318-524a274f7015",
              "startTime": "2019-01-01 09:00:15",
              "duration": 0,
              "caller": "+34633646464",
              "callee": "+34633656565",
              "price": null,
              "endpointType": null,
              "endpointId": null,
              "direction": "outbound",
              "id": 16
          },
          {
              "callid": "017cc7c8-eb38-4bbd-9318-524a274f7016",
              "startTime": "2019-01-01 09:00:16",
              "duration": 0,
              "caller": "+34633646464",
              "callee": "+34633656565",
              "price": null,
              "endpointType": null,
              "endpointId": null,
              "direction": "outbound",
              "id": 17
          },
          {
              "callid": "017cc7c8-eb38-4bbd-9318-524a274f7017",
              "startTime": "2019-01-01 09:00:17",
              "duration": 0,
              "caller": "+34633646464",
              "callee": "+34633656565",
              "price": null,
              "endpointType": null,
              "endpointId": null,
              "direction": "outbound",
              "id": 18
          },
          {
              "callid": "017cc7c8-eb38-4bbd-9318-524a274f7018",
              "startTime": "2019-01-01 09:00:18",
              "duration": 0,
              "caller": "+34633646464",
              "callee": "+34633656565",
              "price": null,
              "endpointType": null,
              "endpointId": null,
              "direction": "outbound",
              "id": 19
          },
          {
              "callid": "017cc7c8-eb38-4bbd-9318-524a274f7019",
              "startTime": "2019-01-01 09:00:19",
              "duration": 0,
              "caller": "+34633646464",
              "callee": "+34633656565",
              "price": null,
              "endpointType": null,
              "endpointId": null,
              "direction": "outbound",
              "id": 20
          },
          {
              "callid": "017cc7c8-eb38-4bbd-9318-524a274f7020",
              "startTime": "2019-01-01 09:00:20",
              "duration": 0,
              "caller": "+34633646464",
              "callee": "+34633656565",
              "price": null,
              "endpointType": null,
              "endpointId": null,
              "direction": "outbound",
              "id": 21
          },
          {
              "callid": "017cc7c8-eb38-4bbd-9318-524a274f7021",
              "startTime": "2019-01-01 09:00:21",
              "duration": 0,
              "caller": "+34633646464",
              "callee": "+34633656565",
              "price": null,
              "endpointType": null,
              "endpointId": null,
              "direction": "outbound",
              "id": 22
          },
          {
              "callid": "017cc7c8-eb38-4bbd-9318-524a274f7022",
              "startTime": "2019-01-01 09:00:22",
              "duration": 0,
              "caller": "+34633646464",
              "callee": "+34633656565",
              "price": null,
              "endpointType": null,
              "endpointId": null,
              "direction": "outbound",
              "id": 23
          },
          {
              "callid": "017cc7c8-eb38-4bbd-9318-524a274f7023",
              "startTime": "2019-01-01 09:00:23",
              "duration": 0,
              "caller": "+34633646464",
              "callee": "+34633656565",
              "price": null,
              "endpointType": null,
              "endpointId": null,
              "direction": "outbound",
              "id": 24
          },
          {
              "callid": "017cc7c8-eb38-4bbd-9318-524a274f7024",
              "startTime": "2019-01-01 09:00:24",
              "duration": 0,
              "caller": "+34633646464",
              "callee": "+34633656565",
              "price": null,
              "endpointType": null,
              "endpointId": null,
              "direction": "outbound",
              "id": 25
          },
          {
              "callid": "017cc7c8-eb38-4bbd-9318-524a274f7025",
              "startTime": "2019-01-01 09:00:25",
              "duration": 0,
              "caller": "+34633646464",
              "callee": "+34633656565",
              "price": null,
              "endpointType": null,
              "endpointId": null,
              "direction": "outbound",
              "id": 26
          },
          {
              "callid": "017cc7c8-eb38-4bbd-9318-524a274f7026",
              "startTime": "2019-01-01 09:00:26",
              "duration": 0,
              "caller": "+34633646464",
              "callee": "+34633656565",
              "price": null,
              "endpointType": null,
              "endpointId": null,
              "direction": "outbound",
              "id": 27
          },
          {
              "callid": "017cc7c8-eb38-4bbd-9318-524a274f7027",
              "startTime": "2019-01-01 09:00:27",
              "duration": 0,
              "caller": "+34633646464",
              "callee": "+34633656565",
              "price": null,
              "endpointType": null,
              "endpointId": null,
              "direction": "outbound",
              "id": 28
          },
          {
              "callid": "017cc7c8-eb38-4bbd-9318-524a274f7028",
              "startTime": "2019-01-01 09:00:28",
              "duration": 0,
              "caller": "+34633646464",
              "callee": "+34633656565",
              "price": null,
              "endpointType": null,
              "endpointId": null,
              "direction": "outbound",
              "id": 29
          },
          {
              "callid": "017cc7c8-eb38-4bbd-9318-524a274f7029",
              "startTime": "2019-01-01 09:00:29",
              "duration": 0,
              "caller": "+34633646464",
              "callee": "+34633656565",
              "price": null,
              "endpointType": null,
              "endpointId": null,
              "direction": "outbound",
              "id": 30
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
          "price": null,
          "destinationName": null,
          "ratingPlanName": null,
          "endpointType": null,
          "endpointId": null,
          "direction": "outbound",
          "id": 1
      }
    """

Feature: Retrieve billable calls

  @createSchema
  Scenario: Retrieve billable call json list
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "billable_calls?_itemsPerPage=2"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      [
          {
              "callid": "017cc7c8-eb38-4bbd-9318-524a274f7104",
              "startTime": "2019-01-01 09:01:44",
              "duration": 0,
              "caller": "+34633646464",
              "callee": "+34633656565",
              "cost": null,
              "price": 1,
              "endpointType": null,
              "endpointId": null,
              "endpointName": null,
              "direction": "outbound",
              "id": 105,
              "company": 5,
              "carrier": 1,
              "invoice": null,
              "ddi": 1,
              "ddiProvider": null
          },
          {
              "callid": "017cc7c8-eb38-4bbd-9318-524a274f7103",
              "startTime": "2019-01-01 09:01:43",
              "duration": 0,
              "caller": "+34633646464",
              "callee": "+34633656565",
              "cost": null,
              "price": 1,
              "endpointType": null,
              "endpointId": null,
              "endpointName": null,
              "direction": "outbound",
              "id": 104,
              "company": 5,
              "carrier": 1,
              "invoice": null,
              "ddi": 1,
              "ddiProvider": null
          }
      ]
      """

  Scenario: Retrieve certain billable call json
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "billable_calls/1"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
      """
      {
          "callid": "017cc7c8-eb38-4bbd-9318-524a274f7000",
          "startTime": "2019-01-01 09:00:00",
          "duration": 0,
          "caller": "+34633646464",
          "callee": "+34633656565",
          "cost": null,
          "price": 1,
          "carrierName": null,
          "destinationName": null,
          "ratingPlanName": null,
          "endpointType": null,
          "endpointId": null,
          "endpointName": null,
          "direction": "outbound",
          "id": 1,
          "company": "~",
          "carrier": "~",
          "destination": null,
          "ratingPlanGroup": null,
          "invoice": "~",
          "ddi": "~",
          "ddiProvider": "~"
      }
      """

Feature: Authorization checking
  In order to use the API
  As a client software developer
  I need to be authorized to access a given resource.

  @createSchema
  Scenario: Admins in UTC timezone should see datetimes properly converted
    Given I add Authorization header for "utcAdmin"
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "billable_calls/1"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
      """
      {
          "callid": "017cc7c8-eb38-4bbd-9318-524a274f7000",
          "startTime": "2019-01-01 08:00:00",
          "duration": 0,
          "caller": "+34633646464",
          "callee": "+34633656565",
          "cost": null,
          "price": 1,
          "priceDetails": [],
          "carrierName": null,
          "destinationName": null,
          "ratingPlanName": null,
          "endpointType": null,
          "endpointId": null,
          "endpointName": null,
          "direction": "outbound",
          "id": 1,
          "brand": {
              "name": "DemoBrand",
              "id": 1,
              "*": "~"
          },
          "company": {
              "name": "Retail Company",
              "id": 3,
              "*": "~"
          },
          "carrier": {
              "name": "AnotherCarrierName",
              "id": 2,
              "*": "~"
          },
          "invoice": {
              "number": "1",
              "id": 1
          },
          "ddi": {
              "ddi": "123",
              "id": 1,
              "*": "~"
          },
          "ddiProvider": {
              "name": "DDIProviderName",
              "id": 1,
              "*": "~"
          }
      }
      """

  Scenario: Admins in Europe/Madrid timezone should see datetimes properly converted
    Given I add Authorization header for "admin"
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
          "priceDetails": [],
          "carrierName": null,
          "destinationName": null,
          "ratingPlanName": null,
          "endpointType": null,
          "endpointId": null,
          "endpointName": null,
          "direction": "outbound",
          "id": 1,
          "brand": {
              "name": "DemoBrand",
              "id": 1,
              "*": "~"
          },
          "company": {
              "name": "Retail Company",
              "id": 3,
              "*": "~"
          },
          "carrier": {
              "name": "AnotherCarrierName",
              "id": 2,
              "*": "~"
          },
          "invoice": {
              "number": "1",
              "id": 1
          },
          "ddi": {
              "ddi": "123",
              "id": 1,
              "*": "~"
          },
          "ddiProvider": {
              "name": "DDIProviderName",
              "id": 1,
              "*": "~"
          }
      }
      """

  Scenario: Admins in Europe/Madrid timezone should be able to filter by date time exact value in their timezone
    Given I add Authorization header for "admin"
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "billable_calls?startTime=2019-01-01%2009%3A00%3A00"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
      """
      [
          {
              "callid": "017cc7c8-eb38-4bbd-9318-524a274f7000",
              "startTime": "2019-01-01 09:00:00",
              "duration": 0,
              "caller": "+34633646464",
              "callee": "+34633656565",
              "cost": null,
              "price": 1,
              "endpointType": null,
              "endpointId": null,
              "endpointName": null,
              "direction": "outbound",
              "id": 1,
              "brand": 1,
              "company": 3,
              "carrier": 2,
              "invoice": 1,
              "ddi": 1,
              "ddiProvider": 1
          }
      ]
      """

  Scenario: Admins in Europe/Madrid timezone should be able to filter by date time before value in their timezone
    Given I add Authorization header for "admin"
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "billable_calls?startTime%5Bbefore%5D=2019-01-01%2009%3A00%3A02"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
      """
      [
          {
              "callid": "017cc7c8-eb38-4bbd-9318-524a274f7002",
              "startTime": "2019-01-01 09:00:02",
              "duration": 0,
              "caller": "+34633646464",
              "callee": "+34633656565",
              "cost": null,
              "price": 1,
              "endpointType": null,
              "endpointId": null,
              "endpointName": null,
              "direction": "outbound",
              "id": 3,
              "brand": 1,
              "company": 1,
              "carrier": 1,
              "invoice": null,
              "ddi": 1,
              "ddiProvider": null
          },
          {
              "callid": "017cc7c8-eb38-4bbd-9318-524a274f7001",
              "startTime": "2019-01-01 09:00:01",
              "duration": 0,
              "caller": "+34633646464",
              "callee": "+34633656565",
              "cost": null,
              "price": 1,
              "endpointType": null,
              "endpointId": null,
              "endpointName": null,
              "direction": "outbound",
              "id": 2,
              "brand": 1,
              "company": 1,
              "carrier": 1,
              "invoice": null,
              "ddi": 1,
              "ddiProvider": 1
          },
          {
              "callid": "017cc7c8-eb38-4bbd-9318-524a274f7000",
              "startTime": "2019-01-01 09:00:00",
              "duration": 0,
              "caller": "+34633646464",
              "callee": "+34633656565",
              "cost": null,
              "price": 1,
              "endpointType": null,
              "endpointId": null,
              "endpointName": null,
              "direction": "outbound",
              "id": 1,
              "brand": 1,
              "company": 3,
              "carrier": 2,
              "invoice": 1,
              "ddi": 1,
              "ddiProvider": 1
          }
      ]
      """

  Scenario: Admins in Europe/Madrid timezone should be able to filter by date time strictly before value in their timezone
    Given I add Authorization header for "admin"
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "billable_calls?startTime%5Bstrictly_before%5D=2019-01-01%2009%3A00%3A02"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
      """
      [
          {
              "callid": "017cc7c8-eb38-4bbd-9318-524a274f7001",
              "startTime": "2019-01-01 09:00:01",
              "duration": 0,
              "caller": "+34633646464",
              "callee": "+34633656565",
              "cost": null,
              "price": 1,
              "endpointType": null,
              "endpointId": null,
              "endpointName": null,
              "direction": "outbound",
              "id": 2,
              "brand": 1,
              "company": 1,
              "carrier": 1,
              "invoice": null,
              "ddi": 1,
              "ddiProvider": 1
          },
          {
              "callid": "017cc7c8-eb38-4bbd-9318-524a274f7000",
              "startTime": "2019-01-01 09:00:00",
              "duration": 0,
              "caller": "+34633646464",
              "callee": "+34633656565",
              "cost": null,
              "price": 1,
              "endpointType": null,
              "endpointId": null,
              "endpointName": null,
              "direction": "outbound",
              "id": 1,
              "brand": 1,
              "company": 3,
              "carrier": 2,
              "invoice": 1,
              "ddi": 1,
              "ddiProvider": 1
          }
      ]
      """

  Scenario: Admins in Europe/Madrid timezone should be able to filter by date time after value in their timezone
    Given I add Authorization header for "admin"
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "billable_calls?startTime%5Bafter%5D=2019-01-01%2009%3A01%3A37"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
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
              "brand": 1,
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
              "brand": 1,
              "company": 5,
              "carrier": 1,
              "invoice": null,
              "ddi": 1,
              "ddiProvider": null
          },
          {
              "callid": "017cc7c8-eb38-4bbd-9318-524a274f7102",
              "startTime": "2019-01-01 09:01:42",
              "duration": 0,
              "caller": "+34633646464",
              "callee": "+34633656565",
              "cost": null,
              "price": 1,
              "endpointType": null,
              "endpointId": null,
              "endpointName": null,
              "direction": "outbound",
              "id": 103,
              "brand": 1,
              "company": 5,
              "carrier": 1,
              "invoice": null,
              "ddi": 1,
              "ddiProvider": null
          },
          {
              "callid": "017cc7c8-eb38-4bbd-9318-524a274f7101",
              "startTime": "2019-01-01 09:01:41",
              "duration": 0,
              "caller": "+34633646464",
              "callee": "+34633656565",
              "cost": null,
              "price": 1,
              "endpointType": null,
              "endpointId": null,
              "endpointName": null,
              "direction": "outbound",
              "id": 102,
              "brand": 1,
              "company": 5,
              "carrier": 1,
              "invoice": null,
              "ddi": 1,
              "ddiProvider": null
          },
          {
              "callid": "017cc7c8-eb38-4bbd-9318-524a274f7100",
              "startTime": "2019-01-01 09:01:40",
              "duration": 0,
              "caller": "+34633646464",
              "callee": "+34633656565",
              "cost": null,
              "price": 1,
              "endpointType": null,
              "endpointId": null,
              "endpointName": null,
              "direction": "outbound",
              "id": 101,
              "brand": 1,
              "company": 5,
              "carrier": 1,
              "invoice": null,
              "ddi": 1,
              "ddiProvider": null
          },
          {
              "callid": "017cc7c8-eb38-4bbd-9318-524a274f7099",
              "startTime": "2019-01-01 09:01:39",
              "duration": 0,
              "caller": "+34633646464",
              "callee": "+34633656565",
              "cost": null,
              "price": 1,
              "endpointType": null,
              "endpointId": null,
              "endpointName": null,
              "direction": "outbound",
              "id": 100,
              "brand": 1,
              "company": 1,
              "carrier": 1,
              "invoice": null,
              "ddi": 1,
              "ddiProvider": null
          },
          {
              "callid": "017cc7c8-eb38-4bbd-9318-524a274f7098",
              "startTime": "2019-01-01 09:01:38",
              "duration": 0,
              "caller": "+34633646464",
              "callee": "+34633656565",
              "cost": null,
              "price": 1,
              "endpointType": null,
              "endpointId": null,
              "endpointName": null,
              "direction": "outbound",
              "id": 99,
              "brand": 1,
              "company": 1,
              "carrier": 1,
              "invoice": null,
              "ddi": 1,
              "ddiProvider": null
          },
          {
              "callid": "017cc7c8-eb38-4bbd-9318-524a274f7097",
              "startTime": "2019-01-01 09:01:37",
              "duration": 0,
              "caller": "+34633646464",
              "callee": "+34633656565",
              "cost": null,
              "price": 1,
              "endpointType": null,
              "endpointId": null,
              "endpointName": null,
              "direction": "outbound",
              "id": 98,
              "brand": 1,
              "company": 1,
              "carrier": 1,
              "invoice": null,
              "ddi": 1,
              "ddiProvider": null
          }
      ]
      """

  Scenario: Admins in Europe/Madrid timezone should be able to filter by date time strictly after value in their timezone
    Given I add Authorization header for "admin"
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "billable_calls?startTime%5Bstrictly_after%5D=2019-01-01%2009%3A01%3A37"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
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
              "brand": 1,
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
              "brand": 1,
              "company": 5,
              "carrier": 1,
              "invoice": null,
              "ddi": 1,
              "ddiProvider": null
          },
          {
              "callid": "017cc7c8-eb38-4bbd-9318-524a274f7102",
              "startTime": "2019-01-01 09:01:42",
              "duration": 0,
              "caller": "+34633646464",
              "callee": "+34633656565",
              "cost": null,
              "price": 1,
              "endpointType": null,
              "endpointId": null,
              "endpointName": null,
              "direction": "outbound",
              "id": 103,
              "brand": 1,
              "company": 5,
              "carrier": 1,
              "invoice": null,
              "ddi": 1,
              "ddiProvider": null
          },
          {
              "callid": "017cc7c8-eb38-4bbd-9318-524a274f7101",
              "startTime": "2019-01-01 09:01:41",
              "duration": 0,
              "caller": "+34633646464",
              "callee": "+34633656565",
              "cost": null,
              "price": 1,
              "endpointType": null,
              "endpointId": null,
              "endpointName": null,
              "direction": "outbound",
              "id": 102,
              "brand": 1,
              "company": 5,
              "carrier": 1,
              "invoice": null,
              "ddi": 1,
              "ddiProvider": null
          },
          {
              "callid": "017cc7c8-eb38-4bbd-9318-524a274f7100",
              "startTime": "2019-01-01 09:01:40",
              "duration": 0,
              "caller": "+34633646464",
              "callee": "+34633656565",
              "cost": null,
              "price": 1,
              "endpointType": null,
              "endpointId": null,
              "endpointName": null,
              "direction": "outbound",
              "id": 101,
              "brand": 1,
              "company": 5,
              "carrier": 1,
              "invoice": null,
              "ddi": 1,
              "ddiProvider": null
          },
          {
              "callid": "017cc7c8-eb38-4bbd-9318-524a274f7099",
              "startTime": "2019-01-01 09:01:39",
              "duration": 0,
              "caller": "+34633646464",
              "callee": "+34633656565",
              "cost": null,
              "price": 1,
              "endpointType": null,
              "endpointId": null,
              "endpointName": null,
              "direction": "outbound",
              "id": 100,
              "brand": 1,
              "company": 1,
              "carrier": 1,
              "invoice": null,
              "ddi": 1,
              "ddiProvider": null
          },
          {
              "callid": "017cc7c8-eb38-4bbd-9318-524a274f7098",
              "startTime": "2019-01-01 09:01:38",
              "duration": 0,
              "caller": "+34633646464",
              "callee": "+34633656565",
              "cost": null,
              "price": 1,
              "endpointType": null,
              "endpointId": null,
              "endpointName": null,
              "direction": "outbound",
              "id": 99,
              "brand": 1,
              "company": 1,
              "carrier": 1,
              "invoice": null,
              "ddi": 1,
              "ddiProvider": null
          }
      ]
      """

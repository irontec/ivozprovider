Feature: Retrieve billable calls

  @createSchema
  Scenario: Retrieve billable call by callId
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "billable_calls?callid=017cc7c8-eb38-4bbd-9318-524a274f7000"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
      """
      [
          {
              "callid": "017cc7c8-eb38-4bbd-9318-524a274f7000",
              "startTime": "2019-01-01 09:00:00",
              "id": 1
          }
      ]
      """

  Scenario: Retrieve billable call by exact callId
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "billable_calls?callid[exact]=017cc7c8-eb38-4bbd-9318-524a274f7000"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
      """
      [
          {
              "callid": "017cc7c8-eb38-4bbd-9318-524a274f7000",
              "startTime": "2019-01-01 09:00:00",
              "id": 1
          }
      ]
      """

  Scenario: Retrieve billable call by not equal callId
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "billable_calls?callid[neq]=017cc7c8-eb38-4bbd-9318-524a274f7000&_itemsPerPage=2"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
      """
      [
          {
              "callid": "017cc7c8-eb38-4bbd-9318-524a274f7001",
              "startTime": "2019-01-01 09:00:01",
              "id": 2
          },
          {
              "callid": "017cc7c8-eb38-4bbd-9318-524a274f7002",
              "startTime": "2019-01-01 09:00:02",
              "id": 3
          }
      ]
      """

  Scenario: Retrieve billable call by callId start
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "billable_calls?callid[start]=017cc7c8-eb38-4bbd-9318-524a274f&_itemsPerPage=2"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
      """
      [
          {
              "callid": "017cc7c8-eb38-4bbd-9318-524a274f7000",
              "startTime": "2019-01-01 09:00:00",
              "id": 1
          },
          {
              "callid": "017cc7c8-eb38-4bbd-9318-524a274f7001",
              "startTime": "2019-01-01 09:00:01",
              "id": 2
          }
      ]
      """

  Scenario: Retrieve billable call by callId partial
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "billable_calls?callid[partial]=eb38-4bbd-9318-524a274f&_itemsPerPage=2"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
      """
      [
          {
              "callid": "017cc7c8-eb38-4bbd-9318-524a274f7000",
              "startTime": "2019-01-01 09:00:00",
              "id": 1
          },
          {
              "callid": "017cc7c8-eb38-4bbd-9318-524a274f7001",
              "startTime": "2019-01-01 09:00:01",
              "id": 2
          }
      ]
      """

  Scenario: Retrieve billable call by callId end
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "billable_calls?callid[end]=9318-524a274f7000&_itemsPerPage=2"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
      """
      [
          {
              "callid": "017cc7c8-eb38-4bbd-9318-524a274f7000",
              "startTime": "2019-01-01 09:00:00",
              "id": 1
          }
      ]
      """

  Scenario: Retrieve billable call by callId exists
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "billable_calls?callid[exists]=true&_itemsPerPage=2"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
      """
      [
          {
              "callid": "017cc7c8-eb38-4bbd-9318-524a274f7000",
              "startTime": "2019-01-01 09:00:00",
              "id": 1
          },
          {
              "callid": "017cc7c8-eb38-4bbd-9318-524a274f7001",
              "startTime": "2019-01-01 09:00:01",
              "id": 2
          }
      ]
      """

  Scenario: Retrieve billable call by startTime
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "billable_calls?startTime=2019-01-01 09:00:00&_itemsPerPage=2"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
      """
      [
          {
              "callid": "017cc7c8-eb38-4bbd-9318-524a274f7000",
              "startTime": "2019-01-01 09:00:00",
              "id": 1
          }
      ]
      """

  Scenario: Retrieve billable call by exact startTime
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "billable_calls?startTime[exact]=2019-01-01 09:00:00&_itemsPerPage=2"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
      """
      [
          {
              "callid": "017cc7c8-eb38-4bbd-9318-524a274f7000",
              "startTime": "2019-01-01 09:00:00",
              "id": 1
          }
      ]
      """

  Scenario: Retrieve billable call by partial startTime
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "billable_calls?startTime=2019-01-01&_itemsPerPage=2"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
      """
      [
          {
              "callid": "017cc7c8-eb38-4bbd-9318-524a274f7000",
              "startTime": "2019-01-01 09:00:00",
              "id": 1
          },
          {
              "callid": "017cc7c8-eb38-4bbd-9318-524a274f7001",
              "startTime": "2019-01-01 09:00:01",
              "id": 2
          }
      ]
      """

  Scenario: Retrieve billable call by startTime start
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "billable_calls?startTime[start]=2019-01-01&_itemsPerPage=2"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
      """
      [
          {
              "callid": "017cc7c8-eb38-4bbd-9318-524a274f7000",
              "startTime": "2019-01-01 09:00:00",
              "id": 1
          },
          {
              "callid": "017cc7c8-eb38-4bbd-9318-524a274f7001",
              "startTime": "2019-01-01 09:00:01",
              "id": 2
          }
      ]
      """

  Scenario: Retrieve billable call by startTime strictly after
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "billable_calls?startTime[strictly_after]=2019-01-01 09:00:00&_itemsPerPage=2"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
      """
      [
          {
              "callid": "017cc7c8-eb38-4bbd-9318-524a274f7001",
              "startTime": "2019-01-01 09:00:01",
              "id": 2
          },
          {
              "callid": "017cc7c8-eb38-4bbd-9318-524a274f7002",
              "startTime": "2019-01-01 09:00:02",
              "id": 3
          }
      ]
      """

  Scenario: Retrieve billable call by startTime after
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "billable_calls?startTime[after]=2019-01-01 09:00:01&_itemsPerPage=2"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
      """
      [
          {
              "callid": "017cc7c8-eb38-4bbd-9318-524a274f7001",
              "startTime": "2019-01-01 09:00:01",
              "id": 2
          },
          {
              "callid": "017cc7c8-eb38-4bbd-9318-524a274f7002",
              "startTime": "2019-01-01 09:00:02",
              "id": 3
          }
      ]
      """

  Scenario: Retrieve billable call by startTime strictly before
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "billable_calls?startTime[strictly_before]=2019-01-01 09:00:01&_itemsPerPage=2"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
      """
      [
          {
              "callid": "017cc7c8-eb38-4bbd-9318-524a274f7000",
              "startTime": "2019-01-01 09:00:00",
              "id": 1
          }
      ]
      """

  Scenario: Retrieve billable call by startTime before
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "billable_calls?startTime[before]=2019-01-01 09:00:01&_itemsPerPage=2"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
      """
      [
          {
              "callid": "017cc7c8-eb38-4bbd-9318-524a274f7000",
              "startTime": "2019-01-01 09:00:00",
              "id": 1
          },
          {
              "callid": "017cc7c8-eb38-4bbd-9318-524a274f7001",
              "startTime": "2019-01-01 09:00:01",
              "id": 2
          }
      ]
      """

  Scenario: Retrieve administrators by brand array
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "administrators?brand[]=1&brand[]=2"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
      """
       [
          {
              "username": "restrictedBrandAdmin",
              "id": 6
          },
          {
              "username": "test_brand_admin",
              "id": 2
          }
      ]
      """

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
            "startTime": "2019-01-01 08:00:00"
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
            "startTime": "2019-01-01 09:00:00"
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
            "startTime": "2019-01-01 09:00:00"
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
              "callid": "017cc7c8-eb38-4bbd-9318-524a274f7000",
              "startTime": "2019-01-01 09:00:00"
          },
          {
              "callid": "017cc7c8-eb38-4bbd-9318-524a274f7001",
              "startTime": "2019-01-01 09:00:01"
          },
          {
              "callid": "017cc7c8-eb38-4bbd-9318-524a274f7002",
              "startTime": "2019-01-01 09:00:02"
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
              "callid": "017cc7c8-eb38-4bbd-9318-524a274f7000",
              "startTime": "2019-01-01 09:00:00"
          },
          {
              "callid": "017cc7c8-eb38-4bbd-9318-524a274f7001",
              "startTime": "2019-01-01 09:00:01"
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
              "callid": "017cc7c8-eb38-4bbd-9318-524a274f7097",
              "startTime": "2019-01-01 09:01:37"
          },
          {
              "callid": "017cc7c8-eb38-4bbd-9318-524a274f7098",
              "startTime": "2019-01-01 09:01:38"
          },
          {
              "callid": "017cc7c8-eb38-4bbd-9318-524a274f7099",
              "startTime": "2019-01-01 09:01:39"
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
              "callid": "017cc7c8-eb38-4bbd-9318-524a274f7098",
              "startTime": "2019-01-01 09:01:38"
          },
          {
              "callid": "017cc7c8-eb38-4bbd-9318-524a274f7099",
              "startTime": "2019-01-01 09:01:39"
          }
      ]
      """

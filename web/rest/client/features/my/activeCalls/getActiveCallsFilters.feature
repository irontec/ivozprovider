Feature: Retrieve active calls filters

  @createSchema
  Scenario: Retrieve company active calls filter json
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "/my/active_calls/realtime_filter"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json"
      And the JSON should be equal to:
      """
      {
          "criteria": "users:b1:c1:*"
      }
      """

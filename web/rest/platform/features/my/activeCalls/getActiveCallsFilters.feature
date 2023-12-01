Feature: Retrieve active calls filters

  @createSchema
  Scenario: Retrieve platform active calls filter json
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "/my/active_calls/realtime_filter?b=1&c=2&dp=4&cr=2&direction=inbound"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json"
      And the JSON should be equal to:
      """
      {
          "criteria": "trunks:b1:c2:cr2:dp4:*"
      }
      """

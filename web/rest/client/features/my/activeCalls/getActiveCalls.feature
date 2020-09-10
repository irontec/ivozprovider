Feature: Retrieve active calls

  @createSchema
  Scenario: Retrieve company total active calls json
    Given I add Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "my/active_calls"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
      {
          "inbound": -1,
          "outbound": -1,
          "total": -2
      }
    """

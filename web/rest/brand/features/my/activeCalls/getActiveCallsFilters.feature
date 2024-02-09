Feature: Retrieve active calls filters

  @createSchema
  Scenario: Retrieve brand active calls error filter json
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "/my/active_calls/realtime_filter?c=1&dp=1&cr=1&direction=inbound"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json"
      And the JSON should be equal to:
      """
      {
          "criteria": "trunks:-1"
      }
      """

  Scenario: Retrieve brand active calls filter json
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "/my/active_calls/realtime_filter?c=1&dp=1"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json"
      And the JSON should be equal to:
      """
      {
          "criteria": "trunks:b1:c1:dp1:*"
      }
      """

  Scenario: Retrieve brand active calls filter json only by carrier
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "/my/active_calls/realtime_filter?cr=2"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json"
      And the JSON should be equal to:
      """
      {
          "criteria": "trunks:b1:*:cr2:*"
      }
      """

  Scenario: Retrieve brand active calls filter json by carrier and direction
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "/my/active_calls/realtime_filter?cr=2&direction=inbound"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json"
      And the JSON should be equal to:
      """
      {
          "criteria": "trunks:-1"
      }
      """

  Scenario: Retrieve brand active calls filter json by ddiProvider and direction
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "/my/active_calls/realtime_filter?dp=1&direction=outbound"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json"
      And the JSON should be equal to:
      """
      {
          "criteria": "trunks:-1"
      }
      """

  Scenario: Carrier filter should has to have priority over direction
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "/my/active_calls/realtime_filter?cr=2&direction=outbound"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json"
      And the JSON should be equal to:
      """
      {
          "criteria": "trunks:b1:*:cr2:*"
      }
      """

  Scenario: Retrieve brand active calls filter json by direction inbound
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "/my/active_calls/realtime_filter?direction=inbound"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json"
      And the JSON should be equal to:
      """
      {
          "criteria": "trunks:b1:*:dp*:*"
      }
      """

  Scenario: Retrieve brand active calls filter json by direction outbound
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "/my/active_calls/realtime_filter?direction=outbound"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json"
      And the JSON should be equal to:
      """
      {
          "criteria": "trunks:b1:*:cr*:*"
      }
      """

  Scenario: Retrieve brand active calls filter json with no parameters
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "/my/active_calls/realtime_filter"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json"
      And the JSON should be equal to:
      """
      {
          "criteria": "trunks:b1:*:*:*"
      }
      """

Feature: Retrieve active calls

  @createSchema
  Scenario: Retrieve brand total active calls json
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "my/active_calls"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
      {
        "total": -1
      }
    """

  Scenario: Retrieve company total active calls json
    Given I add Brand Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "my/active_calls?company=1"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      {
        "total": -1
      }
    """

  Scenario: Show error on unauthorized companyId
    Given I add Brand Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "my/active_calls?company=5"
    Then the response status code should be 422
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/problem+json; charset=utf-8"
    And the JSON should be like:
    """
      {
        "detail": "This company does not belong to your brand"
      }
    """

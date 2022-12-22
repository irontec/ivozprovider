Feature: Retrieve registration summary

  @createSchema
  Scenario: Retrieve brand total registration summary json
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "my/registration_summary"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
      {
          "active": 4,
          "total": 6,
          "percent": 67
      }
    """

  Scenario: Retrieve company total registration summary json
    Given I add Brand Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "my/registration_summary?company=1"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      {
          "active": 2,
          "total": 4,
          "percent": 50
      }
    """
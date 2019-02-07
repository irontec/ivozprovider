Feature: Update billable calls

  @createSchema
  Scenario: Can not update an billable call
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/billable_calls/1" with body:
    """
      {}
    """
    Then the response status code should be 405


Feature: Create billable calls

  @createSchema
  Scenario: Can not create billable calls
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/billable_calls" with body:
    """
      {}
    """
    Then the response status code should be 405

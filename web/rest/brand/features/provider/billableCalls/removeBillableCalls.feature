Feature: Remove billable calls

  @createSchema
  Scenario: Cannot remove a billable calls
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "DELETE" request to "/billable_calls/1"
     Then the response status code should be 405

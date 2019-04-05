Feature: Retrieve my rating plan information by group id

  @createSchema
  Scenario: Retrieve the rating plan csv list
    Given I add Brand Authorization header
     When I add "Accept" header equal to "text/csv"
      And I send a "GET" request to "my/rating_plan_prices?id=1"
     Then the response status code should be 200
      And the header "Content-Type" should be equal to "text/csv; charset=utf-8"
      And the response should be equal to
      """
      Something,Bilbao,+94600,0.01,3.3,1s,0s,00:00:00,1111111
      """

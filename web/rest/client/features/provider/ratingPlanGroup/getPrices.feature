Feature: Retrieve my rating plan information by group id

  @createSchema
  Scenario: Retrieve the rating plan csv list
    Given I add Company Authorization header
     When I add "Accept" header equal to "text/csv"
      And I send a "GET" request to "rating_plan_groups/1/prices"
     Then the response status code should be 200
      And the header "Content-Type" should be equal to "text/csv; charset=utf-8"
      And the streamed response should be equal to:
      """
"rating plan", name, prefix, "connection fee", cost, "rate increment", "group interval start", "time in", days
Something,Bilbao,+94600,0.01,3.3,1s,0s,00:00:00,1111111
      """

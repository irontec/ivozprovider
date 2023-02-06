Feature: Update external call filter white lists
  In order to manage external call filter white lists
  As a client admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update an external call filter white list
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/external_call_filter_white_lists/1" with body:
      """
      {
          "filter": 1,
          "matchlist": 2
      }
      """
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      {
          "id": 1,
          "filter": 1,
          "matchlist": 2
      }
      """

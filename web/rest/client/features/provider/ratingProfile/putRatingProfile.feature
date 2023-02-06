Feature: Update rating profiles
  In order to manage rating profiles
  As a client admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update a rating profile
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/rating_profiles/1" with body:
      """
      {
          "activationTime": "2018-02-02 21:20:20"
      }
      """
     Then the response status code should be 405

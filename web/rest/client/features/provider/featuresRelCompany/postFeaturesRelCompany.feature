Feature: Create features rel companies
  In order to manage features rel companies
  As a client admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create a feature rel company
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/features_rel_companies" with body:
      """
      {
          "feature": 9
      }
      """
     Then the response status code should be 405

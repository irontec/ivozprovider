Feature: Update features rel companies
  In order to manage features rel companies
  As a brand admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update a features rel companies
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/features_rel_companies/1" with body:
      """
      {
          "company": 1,
          "feature": 9
      }
      """
     Then the response status code should be 405

Feature: Create features rel brands
  In order to manage features rel brands
  As a brand admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create a features rel brands
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/features_rel_brands" with body:
      """
      {
          "id": 1,
          "feature": 8
      }
      """
     Then the response status code should be 405

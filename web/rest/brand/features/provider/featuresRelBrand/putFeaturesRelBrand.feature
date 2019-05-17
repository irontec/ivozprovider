Feature: Update features rel brands
  In order to manage features rel brands
  As an super admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update a features rel brands
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/features_rel_brands/1" with body:
    """
      {
          "brand": 1,
          "feature": 9
      }
    """
    Then the response status code should be 405

Feature: Update features rel brands
  In order to manage features rel brands
  as a super admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update an features rel brands is forbidden
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/features_rel_brands/1" with body:
      """
      {
          "brand": 1,
          "feature": 8
      }
      """
     Then the response status code should be 403

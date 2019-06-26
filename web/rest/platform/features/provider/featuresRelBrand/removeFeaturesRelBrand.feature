Feature: Manage features rel brands
  In order to manage features rel brands
  as a super admin
  I need to be able to delete them through the API.

  @createSchema
  Scenario: Remove a feature rel brand
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "DELETE" request to "/features_rel_brands/4"
     Then the response status code should be 204

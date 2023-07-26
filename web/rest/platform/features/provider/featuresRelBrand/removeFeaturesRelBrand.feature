Feature: Manage features rel brands
  In order to manage features rel brands
  as a super admin
  I need to be able to delete them through the API.

  @createSchema
  Scenario: Remove a feature rel brand
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "DELETE" request to "/features_rel_brands/7"
     Then the response status code should be 204

  Scenario: Ensure avoid deletion of feature billing
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "DELETE" request to "/features_rel_brands/6"
     Then the response status code should be 403

  Scenario: Ensure avoid deletion of feature rel brand linked to current company
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "DELETE" request to "/features_rel_brands/4"
     Then the response status code should be 403

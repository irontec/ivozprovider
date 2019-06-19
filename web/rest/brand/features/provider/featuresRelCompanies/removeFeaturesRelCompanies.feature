Feature: Manage features rel companies
  In order to manage features rel companies
  As a brand admin
  I need to be able to delete them through the API.

  @createSchema
  Scenario: Remove a features rel companies
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "DELETE" request to "/features_rel_companies/1"
     Then the response status code should be 204

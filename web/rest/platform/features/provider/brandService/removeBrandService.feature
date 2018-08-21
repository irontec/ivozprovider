Feature: Remove brand services
  In order to manage brand services
  As an super admin
  I need to be able to delete them through the API.

  @createSchema
  Scenario: Remove a brand
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "DELETE" request to "/brand_services/1"
     Then the response status code should be 204
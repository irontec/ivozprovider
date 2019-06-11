Feature: Manage brands
  In order to manage brands
  As an super admin
  I need to be able to delete them through the API.

  @createSchema
  Scenario: Cannot remove brands
    Given I add Brand Authorization header
    When I add "Content-Type" header equal to "application/json"
    And I add "Accept" header equal to "application/json"
    And I send a "DELETE" request to "/brands/1"
    Then the response status code should be 405

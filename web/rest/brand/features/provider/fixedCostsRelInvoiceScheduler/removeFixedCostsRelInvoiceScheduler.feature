Feature: Manage fixed costs rel invoice schedulers
  In order to manage fixed costs rel invoice schedulers
  As a brand admin
  I need to be able to delete them through the API.

  @createSchema
  Scenario: Remove a fixed cost rel invoice scheduler
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "DELETE" request to "/fixed_costs_rel_invoice_schedulers/1"
     Then the response status code should be 204

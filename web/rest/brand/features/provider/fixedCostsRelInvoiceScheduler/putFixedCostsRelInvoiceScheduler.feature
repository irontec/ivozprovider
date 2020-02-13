Feature: Update fixed costs rel invoice schedulers
  In order to manage fixed costs rel invoice schedulers
  As a brand admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update a fixed cost rel invoice scheduler
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/fixed_costs_rel_invoice_schedulers/1" with body:
    """
      {
          "quantity": 2,
          "fixedCost": 1,
          "invoiceScheduler": 1
      }
    """
    Then the response status code should be 200
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be like:
    """
      {
          "quantity": 2,
          "id": 1,
          "fixedCost": "~",
          "invoiceScheduler": "~"
      }
    """

  Scenario: Cannot update anything but quatity
    Given I add Brand Authorization header
    When I add "Content-Type" header equal to "application/json"
    And I add "Accept" header equal to "application/json"
    And I send a "PUT" request to "/fixed_costs_rel_invoice_schedulers/1" with body:
    """
      {
          "quantity": 1,
          "fixedCost": 2,
          "invoiceScheduler": 1
      }
    """
    Then the response status code should be 403

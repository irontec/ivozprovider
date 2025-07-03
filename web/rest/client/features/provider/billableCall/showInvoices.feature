Feature: BillableCall showInvoices functionality
  In order to control price visibility
  As a client admin
  I need to have price fields hidden when showInvoices is false

  @createSchema
  Scenario: Price fields are null when showInvoices is false (Retail Company)
    Given I add Retail Company Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "billable_calls/1"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should contain:
      """
      {
          "price": null
      }
      """

Feature: Regenerate invoice
  In order to manage invoice
  As a brand admin
  I need to be able to regenerate them through the API.

  @createSchema
  Scenario: Regenerate invoice number sequence
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/invoices/1/regenerate"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json"
      And the JSON should be equal to:
      """
      {
          "status": "OK"
      }
      """

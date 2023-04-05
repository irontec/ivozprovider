Feature: Retrieve invoices
  In order to manage invoices
  as a super admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the invoices json list
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "invoices"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      [
          {
              "number": "1",
              "id": 1
          }
      ]
      """

  Scenario: Retrieve certain invoice json
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "invoices/1"
     Then the response status code should be 404

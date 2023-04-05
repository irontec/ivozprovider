Feature: Manage currencies
  In order to manage currencies
  as a super admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create a currency object
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/currencies" with body:
      """
      {
          "iden": "RMB",
          "symbol": "¥",
          "name": {
              "en": "Rénmínbì",
              "es": "Rénmínbì",
              "ca": "Rénmínbì",
              "it": "Rénmínbì"
          }
      }
      """
     Then the response status code should be 201
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      {
          "iden": "RMB",
          "symbol": "¥",
          "id": 4,
          "name": {
              "en": "Rénmínbì",
              "es": "Rénmínbì",
              "ca": "Rénmínbì",
              "it": "Rénmínbì"
          }
      }
      """

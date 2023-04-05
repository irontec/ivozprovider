Feature: Update ddi
  In order to manage call forward settings
  As a brand admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update a ddi
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/ddis/1" with body:
      """
      {
          "ddi": "128",
          "id": 1,
          "company": 1,
          "ddiProvider": 1,
          "country": 68
      }
      """
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      {
          "ddi": "128",
          "ddie164": "+34128",
          "description": "Description for DDI 123",
          "type": "inout",
          "id": 1,
          "company": 1,
          "ddiProvider": 1,
          "country": 68
      }
      """

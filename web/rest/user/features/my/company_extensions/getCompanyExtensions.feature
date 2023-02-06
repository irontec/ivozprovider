Feature: Retrieve company extensions
  In order to manage company extensions
  As a user
  I need to be able to retrieve them through the API.

  @createSchema @userApiContext
  Scenario: Retrieve the company extensions json list
    Given I add User Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "my/company_extensions"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      [
          {
              "number": "101",
              "id": 1
          },
          {
              "number": "102",
              "id": 2
          },
          {
              "number": "12346",
              "id": 3
          },
          {
              "number": "987",
              "id": 4
          }
      ]
      """

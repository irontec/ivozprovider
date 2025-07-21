Feature: Retrieve dashboard

  @createSchema
  Scenario: Retrieve user dashboard json
    Given I add User Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "my/dashboard"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      {
          "userName": "Alice",
          "userLastName": "Allison",
          "extension": "",
          "terminal": "alice",
          "email": "alice@democompany.com",
          "outgoingDdi": "121",
          "productName": "User text"
      }
      """

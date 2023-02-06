Feature: Create Users addresses
  In order to manage Users addresses
  As a brand admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create an Users addresses
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/users_addresses" with body:
      """
      {
        "sourceAddress": "127.0.0.8",
        "description": "Test",
        "company": 1
      }
      """
     Then the response status code should be 201
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
       {
          "sourceAddress": "127.0.0.8",
          "description": "Test",
          "id": 2,
          "company": 1
      }
      """

  Scenario: Retrieve created administrator
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "users_addresses/2"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
      """
      {
          "sourceAddress": "127.0.0.8",
          "description": "Test",
          "id": 2,
          "company": "~"
      }
      """

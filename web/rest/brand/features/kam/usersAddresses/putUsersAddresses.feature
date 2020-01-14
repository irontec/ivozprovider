Feature: Update Users addresses
  In order to manage Users addresses
  As a brand admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update an Users addresses
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/users_addresses/1" with body:
    """
      {
        "sourceAddress": "127.0.0.7",
        "description": "Updated Test",
        "company": 2
      }
    """
    Then the response status code should be 200
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be like:
    """
      {
          "sourceAddress": "127.0.0.7",
          "description": "Updated Test",
          "id": 1,
          "company": "~"
      }
    """

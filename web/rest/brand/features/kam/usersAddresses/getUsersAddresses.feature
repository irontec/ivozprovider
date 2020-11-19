Feature: Retrieve Users addresses
  In order to manage Users addresses
  As a brand admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the Users addresses json list
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "users_addresses"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
      [
          {
              "sourceAddress": "127.0.0.1",
              "description": "Irontec HQ",
              "id": 1,
              "company": 1
          }
      ]
    """

  Scenario: Retrieve certain users addresses json
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "users_addresses/1"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
    """
      {
          "sourceAddress": "127.0.0.1",
          "description": "Irontec HQ",
          "id": 1,
          "company": "~"
      }
    """

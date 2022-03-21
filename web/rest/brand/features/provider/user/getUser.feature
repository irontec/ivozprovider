Feature: Retrieve users
  In order to manage users
  As a brand admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the user json list
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "users"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
      [
          {
              "name": "Alice",
              "lastname": "Allison",
              "id": 1,
              "company": 1,
              "terminal": 1,
              "outgoingDdi": null
          },
          {
              "name": "Bob",
              "lastname": "Bobson",
              "id": 2,
              "company": 1,
              "terminal": 2,
              "outgoingDdi": null
          }
      ]
    """

  Scenario: Retrieve certain user json
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "users/1"
     Then the response status code should be 404

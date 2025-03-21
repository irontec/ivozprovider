Feature: Retrieve users
  In order to manage users
  As a brand admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the user json list with location 1
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "users_for_isbc?location=1"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      [
            {
                "name": "Joe",
                "lastname": "Doe",
                "email": "joe@democompany.com",
                "active": true,
                "id": 3,
                "company": 1,
                "terminal": 4,
                "extension": 2,
                "outgoingDdi": null,
                "location": 1,
                "status": []
            }
      ]
      """

  @createSchema
  Scenario: Retrieve the user json list with location 2
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "users_for_isbc?location=2"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      [
          {
              "name": "Charlie",
              "lastname": "smith",
              "email": "charlie@democompany.com",
              "active": true,
              "id": 4,
              "company": 1,
              "terminal": 5,
              "extension": 5,
              "outgoingDdi": null,
              "location": null,
              "status": []
          }
      ]
      """

  @createSchema
  Scenario: Retrieve the user json list
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "users_for_isbc"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      [
          {
              "name": "Joe",
              "lastname": "Doe",
              "email": "joe@democompany.com",
              "active": true,
              "id": 3,
              "company": 1,
              "terminal": 4,
              "extension": 2,
              "outgoingDdi": null,
              "location": 1,
              "status": []
          },
          {
              "name": "Charlie",
              "lastname": "smith",
              "email": "charlie@democompany.com",
              "active": true,
              "id": 4,
              "company": 1,
              "terminal": 5,
              "extension": 5,
              "outgoingDdi": null,
              "location": null,
              "status": []
          }
      ]
      """

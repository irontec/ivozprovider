Feature: Retrieve friends status
  In order to manage friends status
  As a brand admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the friends status json list
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "friends"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      [
           {
              "name": "InterCompany1_3",
              "description": "",
              "priority": 2,
              "directConnectivity": "intervpbx",
              "id": 3,
              "company": 1,
              "domain": 3,
              "interCompany": 3
          },
          {
              "name": "testFriend",
              "description": "",
              "priority": 1,
              "directConnectivity": "yes",
              "id": 1,
              "company": 1,
              "domain": 3,
              "interCompany": null
          },
          {
              "name": "InterCompany1_3",
              "description": "",
              "priority": 2,
              "directConnectivity": "intervpbx",
              "id": 2,
              "company": 3,
              "domain": 6,
              "interCompany": 1
          }
      ]
      """

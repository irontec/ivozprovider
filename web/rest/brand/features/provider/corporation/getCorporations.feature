Feature: Retrieve corporations
  In order to manage corporation
  As a brand admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the corporation json list
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "corporations"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      [
          {
              "name": "Irontec Test Corporation",
              "id": 1
          },
          {
              "name": "Irontec Test Corporation2",
              "id": 2
          }
      ]
      """

  Scenario: Retrieve certain corporation json
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "corporations/1"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      {
          "name": "Irontec Test Corporation",
          "description": "Irontec Test Desc Corporation",
          "id": 1
      }
      """

Feature: Retrieve domains
  In order to manage domains
  As a brand admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the domain json list
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "domains"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      [
          {
              "domain": "127.0.0.1",
              "id": 3
          },
          {
              "domain": "retail.irontec.com",
              "id": 6
          },
          {
              "domain": "test.irontec.com",
              "id": 5
          }
      ]
      """

  Scenario: Retrieve certain domain json
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "domains/3"
     Then the response status code should be 404

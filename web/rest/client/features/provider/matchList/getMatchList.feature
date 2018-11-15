Feature: Retrieve match lists
  In order to manage match lists
  As an super admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the match lists json list
    Given I add Company Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "match_lists"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      [
          {
              "name": "testMatchlist",
              "id": 1
          },
          {
              "name": "testMatchlist2",
              "id": 2
          }
      ]
    """

  Scenario: Retrieve certain match list json
    Given I add Company Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "match_lists/1"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be like:
    """
      {
          "name": "testMatchlist",
          "id": 1,
          "company": "~"
      }
    """

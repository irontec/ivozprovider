Feature: Retrieve locations
  In order to manage locations
  As a client admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the locations json list
    Given I add Company Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "locations"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      [
          {
              "name": "testLocation",
              "id": 1
          }
      ]
    """

  Scenario: Retrieve certain locations json
    Given I add Company Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "locations/1"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      {
          "name": "testLocation",
          "description": "Test Location description",
          "id": 1
      }
    """

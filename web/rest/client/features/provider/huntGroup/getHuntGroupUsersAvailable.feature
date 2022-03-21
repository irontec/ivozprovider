Feature: Retrieve hunt groups available users
  In order to manage hunt groups
  As a client admin
  I need to be able to retrieve available users through the API.

  @createSchema
  Scenario: Retrieve the hunt groups json list
    Given I add Company Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "hunt_groups/1/users_available"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      [
          {
              "name": "Bob",
              "lastname": "Bobson",
              "id": 2,
              "terminal": 2,
              "extension": null,
              "outgoingDdi": null
          }
      ]
    """

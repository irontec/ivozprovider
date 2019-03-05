Feature: Retrieve destination rate
  In order to manage destination rate
  As an super admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the destination rate json list
    Given I add Brand Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "destination_rates"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      [
          {
              "cost": 3.3,
              "connectFee": 0.01,
              "rateIncrement": "1s",
              "groupIntervalStart": "0s",
              "id": 1,
              "destinationRateGroup": 1,
              "destination": 1
          }
      ]
    """

  Scenario: Retrieve certain destination rate json
    Given I add Brand Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "destination_rates/1"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be like:
    """
      {
          "cost": 3.3,
          "connectFee": 0.01,
          "rateIncrement": "1s",
          "groupIntervalStart": "0s",
          "id": 1,
          "destinationRateGroup": "~",
          "destination": "~"
      }
    """

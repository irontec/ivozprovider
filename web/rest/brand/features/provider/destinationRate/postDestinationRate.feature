  Feature: Create destination rate
  In order to manage destination rate
  As an super admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create a destination rate
    Given I add Brand Authorization header
    When I add "Content-Type" header equal to "application/json"
    And I add "Accept" header equal to "application/json"
    And I send a "POST" request to "/destination_rates" with body:
    """
      {
          "cost": 10.3,
          "connectFee": 0.02,
          "rateIncrement": "1s",
          "groupIntervalStart": "0s",
          "destinationRateGroup": 1,
          "destination": 2
      }
    """
    Then the response status code should be 201
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      {
          "cost": 10.3,
          "connectFee": 0.02,
          "rateIncrement": "1s",
          "groupIntervalStart": "0s",
          "id": 2,
          "destinationRateGroup": 1,
          "destination": 2
      }
    """

  Scenario: Retrieve created destination rate
    Given I add Brand Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "destination_rates/2"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be like:
    """
      {
          "cost": 10.3,
          "connectFee": 0.02,
          "rateIncrement": "1s",
          "groupIntervalStart": "0s",
          "id": 2,
          "destinationRateGroup": "~",
          "destination": "~"
      }
    """

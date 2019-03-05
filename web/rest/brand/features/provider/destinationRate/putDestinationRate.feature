Feature: Update destination rate
  In order to manage destination rate
  As an super admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update a destination rate
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/destination_rates/1" with body:
    """
      {
          "cost": 3.1,
          "connectFee": 0.50,
          "rateIncrement": "1s",
          "groupIntervalStart": "1s",
          "id": 1
      }
    """
    Then the response status code should be 200
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be like:
    """
      {
          "cost": 3.1,
          "connectFee": 0.5,
          "rateIncrement": "1s",
          "groupIntervalStart": "1s",
          "id": 1,
          "destinationRateGroup": "~",
          "destination": "~"
      }
    """

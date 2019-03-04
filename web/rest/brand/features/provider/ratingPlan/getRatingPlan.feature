Feature: Retrieve rating plan
  In order to manage rating plan
  As an super admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the rating plan json list
    Given I add Brand Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "rating_plans"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      [
          {
              "weight": 10,
              "timingType": "always",
              "timeIn": "00:00:00",
              "monday": true,
              "tuesday": true,
              "wednesday": true,
              "thursday": true,
              "friday": true,
              "saturday": true,
              "sunday": true,
              "id": 1,
              "ratingPlanGroup": 1,
              "destinationRateGroup": 1
          }
      ]
    """

  Scenario: Retrieve certain rating plan json
    Given I add Brand Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "rating_plans/1"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be like:
    """
      {
          "weight": 10,
          "timingType": "always",
          "timeIn": "00:00:00",
          "monday": true,
          "tuesday": true,
          "wednesday": true,
          "thursday": true,
          "friday": true,
          "saturday": true,
          "sunday": true,
          "id": 1,
          "ratingPlanGroup": "~",
          "destinationRateGroup": "~"
      }
    """

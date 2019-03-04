  Feature: Create rating plan
  In order to manage rating plan
  As an super admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create a rating plan
    Given I add Brand Authorization header
    When I add "Content-Type" header equal to "application/json"
    And I add "Accept" header equal to "application/json"
    And I send a "POST" request to "/rating_plans" with body:
    """
      {
          "weight": 5,
          "timingType": "custom",
          "timeIn": "20:02:02",
          "monday": true,
          "tuesday": true,
          "wednesday": false,
          "thursday": true,
          "friday": false,
          "saturday": true,
          "sunday": true,
          "ratingPlanGroup": "1",
          "destinationRateGroup": "1"
      }
    """
    Then the response status code should be 201
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      {
          "weight": 5,
          "timingType": "custom",
          "timeIn": "20:02:02",
          "monday": true,
          "tuesday": true,
          "wednesday": false,
          "thursday": true,
          "friday": false,
          "saturday": true,
          "sunday": true,
          "id": 2,
          "ratingPlanGroup": 1,
          "destinationRateGroup": 1
      }
    """

  Scenario: Retrieve created rating plan
    Given I add Brand Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "rating_plans/2"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be like:
    """
      {
          "weight": 5,
          "timingType": "custom",
          "timeIn": "20:02:02",
          "monday": true,
          "tuesday": true,
          "wednesday": false,
          "thursday": true,
          "friday": false,
          "saturday": true,
          "sunday": true,
          "id": 2,
          "ratingPlanGroup": "~",
          "destinationRateGroup": "~"
      }
    """

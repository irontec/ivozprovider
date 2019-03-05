Feature: Update rating plan
  In order to manage rating plan
  As an super admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update a rating plan
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/rating_plans/1" with body:
    """
      {
          "weight": 5,
          "timingType": "custom",
          "timeIn": "10:56:22",
          "monday": false,
          "tuesday": false,
          "wednesday": true,
          "thursday": false,
          "friday": true,
          "saturday": false,
          "sunday": false,
          "ratingPlanGroup": "1",
          "destinationRateGroup": "1"
      }
    """
    Then the response status code should be 200
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be like:
    """
      {
          "weight": 5,
          "timingType": "custom",
          "timeIn": "10:56:22",
          "monday": false,
          "tuesday": false,
          "wednesday": true,
          "thursday": false,
          "friday": true,
          "saturday": false,
          "sunday": false,
          "id": 1,
          "ratingPlanGroup": "~",
          "destinationRateGroup": "~"
      }
    """

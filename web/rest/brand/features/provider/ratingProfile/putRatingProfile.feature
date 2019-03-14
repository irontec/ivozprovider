Feature: Update rating profile
  In order to manage rating profile
  As an super admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update a rating profile
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/rating_profiles/1" with body:
    """
      {
          "activationTime": "2018-03-03 20:30:30",
          "id": 1,
          "company": 2,
          "carrier": null,
          "ratingPlanGroup": 1
      }
    """
    Then the response status code should be 200
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be like:
    """
      {
          "activationTime": "2018-03-03 20:30:30",
          "id": 1,
          "company": "~",
          "carrier": null,
          "ratingPlanGroup": "~"
      }
    """

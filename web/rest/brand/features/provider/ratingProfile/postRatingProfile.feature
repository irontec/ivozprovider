  Feature: Create rating profile
  In order to manage rating profile
  As an super admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create a rating profile
    Given I add Brand Authorization header
    When I add "Content-Type" header equal to "application/json"
    And I add "Accept" header equal to "application/json"
    And I send a "POST" request to "/rating_profiles" with body:
    """
      {
          "activationTime": "2018-03-03 10:00:00",
          "company": 1,
          "carrier": null,
          "ratingPlanGroup": 1
      }
    """
    Then the response status code should be 201
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      {
          "activationTime": "2018-03-03 10:00:00",
          "id": 3,
          "company": 1,
          "carrier": null,
          "ratingPlanGroup": 1
      }
    """

  Scenario: Retrieve created rating profile
    Given I add Brand Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "rating_profiles/3"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be like:
    """
      {
          "activationTime": "2018-03-03 10:00:00",
          "id": 3,
          "company": "~",
          "carrier": null,
          "ratingPlanGroup": "~"
      }
    """

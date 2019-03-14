Feature: Retrieve rating profile
  In order to manage rating profile
  As an super admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the rating profile json list
    Given I add Brand Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "rating_profiles"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      [
          {
              "activationTime": "2018-02-02 21:20:20",
              "id": 1,
              "company": 1,
              "carrier": 1,
              "ratingPlanGroup": 1
          },
          {
              "activationTime": "2018-02-02 21:20:20",
              "id": 2,
              "company": 1,
              "carrier": null,
              "ratingPlanGroup": 2
          }
      ]
    """

  Scenario: Retrieve certain rating profile json
    Given I add Brand Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "rating_profiles/1"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be like:
    """
      {
          "activationTime": "2018-02-02 21:20:20",
          "id": 1,
          "company": "~",
          "carrier": "~",
          "ratingPlanGroup": "~"
      }
    """

Feature: Retrieve rating profiles
  In order to manage rating profiles
  As an super admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the rating profiles json list
    Given I add Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "rating_profiles"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      [
          {
              "id": 1
          },
          {
              "id": 2
          }
      ]
    """

  Scenario: Retrieve certain rating profile json
    Given I add Authorization header
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
          "ratingPlan": {
              "tag": "b1rp1",
              "id": 1,
              "name": {
                  "en": "Something",
                  "es": "Algo"
              },
              "description": {
                  "en": "",
                  "es": ""
              },
              "brand": 1
          },
          "routingTag": null
      }
    """

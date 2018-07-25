Feature: Update rating profiles
  In order to manage rating profiles
  As an super admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update a rating profile
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/rating_profiles/1" with body:
    """
      {
          "activationTime": "2018-01-01T10:10:10Z",
          "company": 1,
          "routingTag": 1,
          "ratingPlan": 1
      }
    """
    Then the response status code should be 200
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be like:
    """
      {
          "activationTime": "2018-01-01 11:10:10",
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
          "routingTag": {
              "name": "TagName",
              "tag": "aTag",
              "id": 1,
              "brand": 1
          }
      }
    """

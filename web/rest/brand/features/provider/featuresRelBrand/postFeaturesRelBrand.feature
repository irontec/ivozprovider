  Feature: Create features rel brands
  In order to manage features rel brands
  As an super admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create a features rel brands
    Given I add Brand Authorization header
    When I add "Content-Type" header equal to "application/json"
    And I add "Accept" header equal to "application/json"
    And I send a "POST" request to "/features_rel_brands" with body:
    """
      {
          "id": 1,
          "brand": 1,
          "feature": 8
      }
    """
    Then the response status code should be 201
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      {
          "id": 8,
          "brand": 1,
          "feature": 8
      }
    """

  Scenario: Retrieve created features rel brands
    Given I add Brand Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "features_rel_brands/2"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be like:
    """
       {
          "id": 2,
          "brand": "~",
          "feature": {
              "iden": "recordings",
              "id": 2,
              "name": {
                  "en": "en",
                  "es": "es"
              }
          }
      }
    """

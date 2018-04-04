Feature: Create features rel companies
  In order to manage features rel companies
  As an super admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create a feature rel company
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/features_rel_companies" with body:
    """
      {
          "company": 2,
          "feature": 1
      }
    """
    Then the response status code should be 201
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be like:
    """
      {
          "id": 6,
          "company": "~",
          "feature": {
              "iden": "queues",
              "id": 1,
              "name": {
                  "en": "en",
                  "es": "es"
              }
          }
      }
    """

  Scenario: Retrieve created features rel company
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "features_rel_companies/6"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
    """
      {
          "id": 6,
          "company": "~",
          "feature": {
              "iden": "queues",
              "id": 1,
              "name": {
                  "en": "en",
                  "es": "es"
              }
          }
      }
    """

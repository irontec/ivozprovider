Feature: Update features rel companies
  In order to manage features rel companies
  As an super admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update a feature rel company
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/features_rel_companies/1" with body:
    """
      {
          "id": 1,
          "company": 2,
          "feature": 2
      }
    """
    Then the response status code should be 200
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be like:
    """
      {
          "id": 1,
          "company": "~",
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

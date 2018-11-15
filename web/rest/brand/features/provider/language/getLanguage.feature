Feature: Retrieve languages
  In order to manage languages
  As an super admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the languages json list
    Given I add Brand Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "languages"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      [
          {
              "iden": "es",
              "id": 1
          },
          {
              "iden": "en",
              "id": 2
          }
      ]
    """

  Scenario: Retrieve certain language json
    Given I add Brand Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "languages/1"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      {
          "iden": "es",
          "id": 1,
          "name": {
              "en": "es",
              "es": "es"
          }
      }
    """

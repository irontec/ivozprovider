Feature: Retrieve ddi providers
  In order to manage ddi providers
  as a super admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the ddi providers json list
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "ddi_providers"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      [
          {
              "name": "DDIProviderName",
              "id": 1
          }
      ]
      """

  Scenario: Retrieve certain ddi provider json
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "ddi_providers/1"
     Then the response status code should be 404

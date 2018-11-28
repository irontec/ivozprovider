Feature: Retrieve ddi provider addresses
  In order to manage ddi provider addresses
  As an super admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the ddi provider addresses json list
    Given I add Brand Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "ddi_provider_addresses"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      [
          {
              "ip": "127.0.0.1",
              "description": "DDI Provider Address 1",
              "id": 1
          }
      ]
    """

  Scenario: Retrieve ddi provider address json
    Given I add Brand Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "ddi_provider_addresses/1"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be like:
    """
      {
          "ip": "127.0.0.1",
          "description": "DDI Provider Address 1",
          "id": 1,
          "ddiProvider": {
              "description": "DDIProviderDescription",
              "name": "DDIProviderName",
              "id": 1,
              "brand": 1,
              "transformationRuleSet": 1
          }
      }
    """

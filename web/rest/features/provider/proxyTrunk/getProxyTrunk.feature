Feature: Retrieve proxy trunks
  In order to manage proxy trunks
  As an super admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the proxy trunks json list
    Given I add Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "proxy_trunks"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      [
         {
            "name": "proxytrunks",
            "ip": "127.0.0.1",
            "id": 1
        }
      ]
    """

  Scenario: Retrieve certain proxy trunk json
    Given I add Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "proxy_trunks/1"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      {
          "name": "proxytrunks",
          "ip": "127.0.0.1",
          "id": 1
      }
    """

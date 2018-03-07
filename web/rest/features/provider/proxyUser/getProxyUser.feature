Feature: Retrieve proxy users
  In order to manage proxy users
  As an super admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the proxy users json list
    Given I add Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "proxy_users"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      [
        {
          "name": "proxyusers",
          "ip": "127.0.0.1",
          "id": 1
        }
      ]
    """

  Scenario: Retrieve certain proxy user json
    Given I add Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "proxy_users/1"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      {
          "name": "proxyusers",
          "ip": "127.0.0.1",
          "id": 1
      }
    """

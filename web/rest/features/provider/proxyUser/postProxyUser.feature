Feature: Create proxy users
  In order to manage proxy users
  As an super admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create a proxy user
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/proxy_users" with body:
    """
      {
          "name": "new proxyuser",
          "ip": "127.0.1.1"
      }
    """
    Then the response status code should be 201
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be equal to:
    """
      {
          "name": "new proxyuser",
          "ip": "127.0.1.1",
          "id": 2
      }
    """

  Scenario: Retrieve created proxy user
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "proxy_users/2"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
      {
          "name": "new proxyuser",
          "ip": "127.0.1.1",
          "id": 2
      }
    """

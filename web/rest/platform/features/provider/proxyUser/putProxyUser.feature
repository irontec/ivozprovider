Feature: Update proxy users
  In order to manage proxy users
  As an super admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update a proxy users
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/proxy_users/1" with body:
    """
      {
          "name": "updated proxyuser",
          "ip": "127.0.0.2"
      }
    """
    Then the response status code should be 200
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be equal to:
    """
      {
          "name": "updated proxyuser",
          "ip": "127.0.0.2",
          "id": 1
      }
    """

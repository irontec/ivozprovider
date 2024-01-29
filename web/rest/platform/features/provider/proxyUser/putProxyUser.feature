Feature: Update proxy users
  In order to manage proxy users
  as a super admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update proxy user #1
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/proxy_users/1" with body:
      """
      {
          "ip": "127.0.0.2",
          "advertisedIp": "138.0.0.2"
      }
      """
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      {
          "name": "proxyusers",
          "ip": "127.0.0.2",
          "advertisedIp": "138.0.0.2",
          "id": 1
      }
      """

  Scenario: Cannot update the name of proxy user #1
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/proxy_users/1" with body:
      """
      {
          "name": "updated pu",
          "ip": "127.0.0.2",
          "advertisedIp": "138.0.0.2"
      }
      """
     Then the response status code should be 403

  Scenario: Update all properties on proxy user with id != 1
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/proxy_users/2" with body:
      """
      {
          "name": "updated name",
          "ip": "99.0.0.2",
          "advertisedIp": "99.0.0.2"
      }
      """
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      {
          "name": "updated name",
          "ip": "99.0.0.2",
          "advertisedIp": "99.0.0.2",
          "id": 2
      }
      """

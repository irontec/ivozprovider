Feature: Update proxy trunks
  In order to manage proxy trunks
  as a super admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update a proxy trunk #1
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/proxy_trunks/1" with body:
      """
      {
          "ip": "127.0.0.10",
          "advertisedIp": "138.0.0.10"
      }
      """
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      {
          "name": "proxytrunks",
          "ip": "127.0.0.10",
          "advertisedIp": "138.0.0.10",
          "id": 1
      }
      """

  Scenario: Cannot update the name of proxy trunk #1
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/proxy_trunks/1" with body:
      """
      {
          "name": "updated pt"
      }
      """
     Then the response status code should be 403

  Scenario: Update all properties on proxy trunk with id != 1
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/proxy_trunks/2" with body:
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

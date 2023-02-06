Feature: Create routing tags
  In order to manage routing tags
  As a brand admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create a routing tags
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/routing_tags" with body:
      """
      {
          "name": "Mine",
          "tag": "00#",
          "id": 1
      }
      """
     Then the response status code should be 201
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      {
          "name": "Mine",
          "tag": "00#",
          "id": 2
      }
      """

  Scenario: Retrieve created routing pattern
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "routing_tags/2"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
      """
      {
          "name": "Mine",
          "tag": "00#",
          "id": 2
      }
      """

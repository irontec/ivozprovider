Feature: Update routing tags
  In order to manage routing tags
  As a company admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update a routing pattern
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/routing_tags/1" with body:
      """
      {
          "name": "TagName",
          "tag": "090#",
          "id": 1
      }
      """
     Then the response status code should be 405

Feature: Manage media relay sets
  In order to manage media relay sets
  as a super admin
  I need to be able to delete them through the API.

  @createSchema
  Scenario: Remove a media relay sets
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "DELETE" request to "/media_relay_sets/2"
     Then the response status code should be 204

  @createSchema
  Scenario: Remove default media relay sets
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "DELETE" request to "/media_relay_sets/0"
     Then the response status code should be 403
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/problem+json; charset=utf-8"
      And the exception should match:
      """
      {
        "detail": "Rejected request during security check"
      }
      """

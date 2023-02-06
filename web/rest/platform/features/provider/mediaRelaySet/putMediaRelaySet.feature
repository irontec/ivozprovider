Feature: Update media relay sets
  In order to manage media relay sets
  as a super admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update a media relay set
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/media_relay_sets/1" with body:
      """
      {
          "name": "Updated",
          "description": "Updated media relay set"
      }
      """
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      {
           "name": "Updated",
           "description": "Updated media relay set",
           "id": 1
      }
      """

  @createSchema
  Scenario: Default media relay set cannot be updated
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/media_relay_sets/0" with body:
      """
      {
          "name": "Updated",
          "description": "Updated media relay set"
      }
      """
     Then the response status code should be 403

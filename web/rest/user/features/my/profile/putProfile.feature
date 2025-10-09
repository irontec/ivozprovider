Feature: Update profile
  In order to manage profile
  As a user
  I need to be able to update my profile through the API.

  @createSchema @userApiContext
  Scenario: Update profile without password change
    Given I add User Authorization header
      And I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
     When I send a "PUT" request to "my/profile" with body:
      """
      {
        "name": "Alice Updated",
        "lastname": "Allison Updated",
        "email": "alice.updated@democompany.com"
      }
      """
     Then the response status code should be 200
      And the response should be in JSON

  @createSchema @userApiContext
  Scenario: Try to change password without oldPass should fail
    Given I add User Authorization header
      And I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
     When I send a "PUT" request to "my/profile" with body:
      """
      {
        "name": "Alice",
        "lastname": "Allison",
        "email": "alice@democompany.com",
        "pass": "newPassword123"
      }
      """
     Then the response status code should be 400
      And the response should be in JSON
      And the JSON node "detail" should contain "oldPass is required when changing password"

  @createSchema @userApiContext
  Scenario: Change password with correct oldPass should succeed
    Given I add User Authorization header
      And I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
     When I send a "PUT" request to "my/profile" with body:
      """
      {
        "name": "Alice",
        "lastname": "Allison",
        "email": "alice@democompany.com",
        "pass": "newPassword123",
        "oldPass": "changeme"
      }
      """
     Then the response status code should be 200
      And the response should be in JSON

  @createSchema @userApiContext
  Scenario: Try to change password with wrong oldPass should fail
    Given I add User Authorization header
      And I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
     When I send a "PUT" request to "my/profile" with body:
      """
      {
        "name": "Alice",
        "lastname": "Allison",
        "email": "alice@democompany.com",
        "pass": "newPassword123",
        "oldPass": "wrongPassword"
      }
      """
     Then the response status code should be 400
      And the response should be in JSON
      And the JSON node "detail" should contain "Invalid password"

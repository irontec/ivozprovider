Feature: Create terminal models
  In order to manage terminal models
  As a client admin
  I should not be able to create them through the API.

  @createSchema
  Scenario: Create a terminal model
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/terminal_models" with body:
    """
      {
      }
    """
    Then the response status code should be 405

Feature: Update terminal models
  In order to manage terminal models
  As a client admin
  I should not be able to update them through the API.

  @createSchema
  Scenario: Update a terminal model
    Given I add Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/terminal_models/1" with body:
    """
      {
      }
    """
    Then the response status code should be 405

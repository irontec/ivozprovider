Feature: Remove call CSV scheduler
  In order to manage call CSV scheduler
  As a brand admin
  I need to be able to delete them through the API.

  @createSchema
  Scenario: Remove a scheduler
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "DELETE" request to "/call_csv_schedulers/1"
     Then the response status code should be 204

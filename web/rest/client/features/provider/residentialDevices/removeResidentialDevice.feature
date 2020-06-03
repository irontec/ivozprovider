Feature: Manage residential devices
  In order to manage residential devices
  As a client admin
  I need to be able to delete them through the API.

  @createSchema
  Scenario: Remove a residential device
    Given I add Residential Company Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "DELETE" request to "/residential_devices/1"
     Then the response status code should be 405

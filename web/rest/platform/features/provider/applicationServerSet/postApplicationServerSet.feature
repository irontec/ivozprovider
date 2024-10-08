Feature: Create application server set
  In order to manage application server sets
  as a super admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create an application server set
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/application_server_sets" with body:
      """
      {
        "name": "testPostAps",
        "distributeMethod": "rr",
        "description": "Test create application server set",
        "applicationServers": [
            3,
            1
        ]
      }
      """
     Then the response status code should be 201
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      {
          "name": "testPostAps",
          "distributeMethod": "rr",
          "description": "Test create application server set",
          "id": 3,
          "applicationServers": [
              3,
              1
          ]
      }
      """

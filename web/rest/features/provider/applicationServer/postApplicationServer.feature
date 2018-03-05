Feature: Create application servers
  In order to manage application servers
  As an super admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create an application servers
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/application_servers" with body:
    """
      {
        "ip": "127.2.2.2",
        "name": "test002"
      }
    """
    Then the response status code should be 201
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be equal to:
    """
      {
          "name": "test002",
          "id": 3
      }
    """

  Scenario: Retrieve created application server
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "application_servers/3"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
      {
          "ip": "127.2.2.2",
          "name": "test002",
          "id": 3
      }
    """

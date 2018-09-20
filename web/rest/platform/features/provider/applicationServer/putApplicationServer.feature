Feature: Update application servers
  In order to manage application servers
  As an super admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update an application server
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/application_servers/2" with body:
    """
      {
        "ip": "127.1.1.2",
        "name": "updatedTest001"
      }
    """
    Then the response status code should be 200
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be equal to:
    """
      {
          "ip": "127.1.1.2",
          "name": "updatedTest001",
          "id": 2
      }
    """

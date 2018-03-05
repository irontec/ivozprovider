Feature: Update domain
  In order to manage domains
  As an super admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update a domain
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/domains/1" with body:
    """
      {
          "domain": "users-updated.ivozprovider.local",
          "pointsTo": "proxytrunks",
          "description": "Minimal proxytrunks global domain"
      }
    """
    Then the response status code should be 200
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be equal to:
    """
      {
        "domain": "users-updated.ivozprovider.local",
        "pointsTo": "proxytrunks",
        "description": "Minimal proxytrunks global domain",
        "id": 1
      }
    """

Feature: Authorization checking
  In order to use the API
  As a client software developer
  I need to be authorized to access a given resource.

  @createSchema
  Scenario: A read only admin cannot create a resource
    Given I add Authorization header for "restrictedBrandAdmin"
    When I add "Accept" header equal to "application/ld+json"
    When I add "Content-Type" header equal to "application/json"
    And I add "Accept" header equal to "application/json"
    And I send a "POST" request to "/administrators" with body:
    """
      {
          "username": "someUser"
      }
    """
    Then the response status code should be 403

  Scenario: A read only admin can read a resource
    Given I add Authorization header for "restrictedBrandAdmin"
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "administrators/4"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be like:
    """
      {
          "username": "test_company_admin",
          "pass": "****",
          "email": "test@irontec.com",
          "active": true,
          "restricted": false,
          "name": "Admin Name",
          "lastname": "Admin Lastname",
          "id": 4,
          "company": "~",
          "timezone": {
              "tz": "Europe/Madrid",
              "comment": "mainland",
              "id": 145,
              "label": {
                  "en": "en",
                  "es": "es"
              },
              "country": 68
          }
      }
    """

  Scenario: A read only admin cannot update a resource
    Given I add Authorization header for "restrictedBrandAdmin"
    When I add "Content-Type" header equal to "application/json"
    And I add "Accept" header equal to "application/json"
    And I send a "PUT" request to "/administrators/4" with body:
    """
      {
          "username": "newUserName",
          "pass": "1234",
          "email": "modified@example.com",
          "active": false,
          "restricted": true,
          "name": "Updated admin name",
          "lastname": "a lastname",
          "company": 1,
          "timezone": 158
      }
    """
    Then the response status code should be 403

  Scenario: A read only admin cannot delete a resource
    Given I add Authorization header for "restrictedBrandAdmin"
    When I add "Content-Type" header equal to "application/json"
    And I add "Accept" header equal to "application/json"
    And I send a "DELETE" request to "/administrators/4"
    Then the response status code should be 403

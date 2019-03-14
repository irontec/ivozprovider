Feature: Create administrators
  In order to manage administrators
  As an super admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create an administrators
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/administrators" with body:
    """
      {
          "username": "post-test",
          "pass": "changeme",
          "email": "post-test@example.com",
          "active": true,
          "name": "post",
          "lastname": "test",
          "id": 1,
          "brand": 1,
          "company": null,
          "timezone": 1
      }
    """
    Then the response status code should be 201
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be equal to:
    """
      {
          "username": "post-test",
          "pass": "****",
          "email": "post-test@example.com",
          "active": true,
          "name": "post",
          "lastname": "test",
          "id": 6,
          "brand": 1,
          "company": null,
          "timezone": 1
      }
    """

  Scenario: Retrieve created administrator
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "administrators/6"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
    """
      {
          "username": "post-test",
          "pass": "****",
          "email": "post-test@example.com",
          "active": true,
          "name": "post",
          "lastname": "test",
          "id": 6,
          "brand": "~",
          "company": null,
          "timezone": {
              "tz": "Europe\/Madrid",
              "comment": "mainland",
              "id": 1,
              "label": {
                  "en": "en",
                  "es": "es"
              },
              "country": 1
          }
      }
    """

  @createSchema
  Scenario: Fails on unauthorized brand
    Given I add Brand Authorization header
    When I add "Content-Type" header equal to "application/json"
    And I add "Accept" header equal to "application/json"
    And I send a "POST" request to "/administrators" with body:
    """
      {
          "username": "post-test",
          "pass": "changeme",
          "email": "post-test@example.com",
          "active": true,
          "name": "post",
          "lastname": "test",
          "id": 1,
          "brand": 2,
          "company": null,
          "timezone": 1
      }
    """
    Then the response status code should be 403


  @createSchema
  Scenario: Fails on unauthorized company
    Given I add Brand Authorization header
    When I add "Content-Type" header equal to "application/json"
    And I add "Accept" header equal to "application/json"
    And I send a "POST" request to "/administrators" with body:
    """
      {
          "username": "post-test",
          "pass": "changeme",
          "email": "post-test@example.com",
          "active": true,
          "name": "post",
          "lastname": "test",
          "id": 1,
          "brand": 1,
          "company": 99,
          "timezone": 1
      }
    """
    Then the response status code should be 403

Feature: Create administrators
  In order to manage administrators
  as a super admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create an administrators
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/administrators" with body:
    """
      {
          "username": "post-test",
          "pass": "changeme",
          "email": "post-test@example.com",
          "active": true,
          "restricted": false,
          "name": "post",
          "lastname": "test",
          "id": 1,
          "brand": null,
          "company": null,
          "timezone": 145
      }
    """
    Then the response status code should be 201
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be equal to:
    """
      {
          "username": "post-test",
          "pass": "*****",
          "email": "post-test@example.com",
          "active": true,
          "restricted": false,
          "name": "post",
          "lastname": "test",
          "id": 12,
          "brand": null,
          "company": null,
          "timezone": 145
      }
    """

  Scenario: Retrieve created administrator
    Given I add Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "administrators/12"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
    """
      {
          "username": "post-test",
          "pass": "*****",
          "email": "post-test@example.com",
          "active": true,
          "restricted": false,
          "name": "post",
          "lastname": "test",
          "id": 12,
          "brand": null,
          "company": null,
          "timezone": {
              "tz": "Europe/Madrid",
              "comment": "mainland",
              "id": 145,
              "label": {
                  "en": "en",
                  "es": "es",
                  "ca": "ca",
                  "it": "it"
              },
              "country": 68
          }
      }
    """

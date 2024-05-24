Feature: Retrieve faxes
  In order to manage faxes
  As a user
  I need to be able to retrieve them through the API.

  @createSchema @userApiContext
  Scenario: Retrieve the faxes json list
    Given I add User Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "/my/faxes"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      [
          {
              "name": "Test Fax",
              "email": null,
              "sendByEmail": false,
              "id": 1
          }
      ]
      """

  @createSchema @userApiContext
  Scenario: Retrieve a certain faxes json item
    Given I add User Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "faxes/1"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
                {
                    "name": "Test Fax",
                    "email": null,
                    "sendByEmail": false,
                    "id": 1,
      		          "relUserIds": [
                      1
                    ]
                }
      """

  @createSchema @userApiContext
  Scenario: Retrieve a certain faxes item without permissions
    Given I add User Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "/my/faxes/2"
     Then the response status code should be 404

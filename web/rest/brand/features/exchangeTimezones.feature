Feature: Authorization checking
  In order to use the API
  As a client software developer
  I need to be authorized to access a given resource.

  @createSchema
  Scenario: Internal admin inherits parent admin Europe/Madrid timezone
    When I exchange "admin" platform token for "__b1_internal" brand token
     And I add "Accept" header equal to "application/json"
     And I send a "GET" request to "balance_movements"
    Then the response status code should be 200
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be like:
      """
      [
          {
              "createdOn": "2022-09-02 12:17:10",
              "id": 1,
              "amount": 10,
              "balance": 10,
              "company": 1,
              "carrier": null
          },
          {
              "createdOn": "2022-09-02 12:17:11",
              "id": 2,
              "amount": 25,
              "balance": 27,
              "company": 1,
              "carrier": null
          },
          {
              "createdOn": "2022-09-02 12:17:12",
              "id": 3,
              "amount": 500,
              "balance": 567.23,
              "company": null,
              "carrier": 1
          }
      ]
      """

  Scenario: Internal admin inherits parent admin UTC timezone
    When I exchange "utcAdmin" platform token for "__b1_internal" brand token
     And I add "Accept" header equal to "application/json"
     And I send a "GET" request to "balance_movements"
    Then the response status code should be 200
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be like:
      """
      [
          {
              "createdOn": "2022-09-02 10:17:10",
              "id": 1,
              "amount": 10,
              "balance": 10,
              "company": 1,
              "carrier": null
          },
          {
              "createdOn": "2022-09-02 10:17:11",
              "id": 2,
              "amount": 25,
              "balance": 27,
              "company": 1,
              "carrier": null
          },
          {
              "createdOn": "2022-09-02 10:17:12",
              "id": 3,
              "amount": 500,
              "balance": 567.23,
              "company": null,
              "carrier": 1
          }
      ]
      """

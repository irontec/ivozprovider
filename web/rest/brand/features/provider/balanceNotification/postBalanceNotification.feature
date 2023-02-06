Feature: Create balance notifications
  In order to manage balance notifications
  As a brand admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create an balance notification
    Given I add Brand Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "POST" request to "/balance_notifications" with body:
      """
      {
          "company": 1,
          "toAddress": "new@address.com",
          "threshold": 1230.0001
      }
      """
     Then the response status code should be 201
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be equal to:
      """
      {
          "toAddress": "new@address.com",
          "threshold": 1230.0001,
          "lastSent": null,
          "id": 3,
          "company": 1,
          "carrier": null,
          "notificationTemplate": null
      }
      """

  Scenario: Retrieve created balance notifications
    Given I add Brand Authorization header
     When I add "Accept" header equal to "application/json"
      And I send a "GET" request to "balance_notifications/3"
     Then the response status code should be 200
      And the response should be in JSON
      And the header "Content-Type" should be equal to "application/json; charset=utf-8"
      And the JSON should be like:
      """
      {
          "toAddress": "new@address.com",
          "threshold": 1230.0001,
          "lastSent": null,
          "id": 3,
          "company": "~",
          "notificationTemplate": null
      }
      """

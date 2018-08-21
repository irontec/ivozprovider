Feature: Update balance notifications
  In order to manage balance notifications
  As an super admin
  I need to be able to update them through the API.

  @createSchema
  Scenario: Update an balance notification
    Given I add Authorization header
     When I add "Content-Type" header equal to "application/json"
      And I add "Accept" header equal to "application/json"
      And I send a "PUT" request to "/balance_notifications/1" with body:
    """
      {
          "id": 1,
          "company": 1,
          "toAddress": "updated@address",
          "threshold": 1.0003
      }
    """
    Then the response status code should be 200
     And the response should be in JSON
     And the header "Content-Type" should be equal to "application/json; charset=utf-8"
     And the JSON should be like:
    """
      {
          "toAddress": "updated@address",
          "threshold": 1.0003,
          "lastSent": null,
          "id": 1,
          "company": "~",
          "notificationTemplate": null
      }
    """

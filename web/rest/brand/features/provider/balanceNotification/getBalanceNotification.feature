Feature: Retrieve balance notifications
  In order to manage balance notifications
  As an super admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the balance notifications json list
    Given I add Brand Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "balance_notifications"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      [
            {
                "toAddress": "balance@ivozprovider.com",
                "threshold": 4.5,
                "id": 1
            },
            {
                "toAddress": "balance2@ivozprovider.com",
                "threshold": 0,
                "id": 2
            }
      ]
    """

  Scenario: Retrieve certain balance notifications json
    Given I add Brand Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "balance_notifications/1"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be like:
    """
      {
          "toAddress": "balance@ivozprovider.com",
          "threshold": 4.5,
          "lastSent": null,
          "id": 1,
          "company": "~",
          "notificationTemplate": {
              "name": "Voicemail notification",
              "type": "voicemail",
              "id": 1,
              "brand": 1
          }
      }
    """

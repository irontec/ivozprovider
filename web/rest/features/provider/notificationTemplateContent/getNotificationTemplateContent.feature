Feature: Retrieve notification template contents
  In order to manage notification template contents
  As an super admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the notification template contents json list
    Given I add Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "notification_template_contents"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      [
          {
              "fromName": "IvozProvider Notification",
              "fromAddress": "no-reply@ivozprovider.com",
              "id": 1
          }
      ]
    """

  Scenario: Retrieve certain notification template contents json
    Given I add Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "notification_template_contents/1"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      {
          "fromName": "IvozProvider Notification",
          "fromAddress": "no-reply@ivozprovider.com",
          "subject": "test subject",
          "body": "test body",
          "id": 1,
          "notificationTemplate": {
              "name": "Voicemail notification",
              "type": "voicemail",
              "id": 1,
              "brand": 1
          },
          "language": {
              "iden": "es",
              "id": 1,
              "name": {
                  "en": "es",
                  "es": "es"
              }
          }
      }
    """

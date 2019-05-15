Feature: Create notification templates
  In order to manage notification templates
  As an super admin
  I need to be able to create them through the API.

  @createSchema
  Scenario: Create an notification template
    Given I add Brand Authorization header
    When I add "Content-Type" header equal to "application/json"
    And I add "Accept" header equal to "application/json"
    And I send a "POST" request to "/notification_templates" with body:
    """
      {
          "name": "New fax notification",
          "type": "fax"
      }
    """
    Then the response status code should be 201
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      {
          "name": "New fax notification",
          "type": "fax",
          "id": 3,
          "brand": 1
      }
    """

  Scenario: Retrieve created notification template
    Given I add Brand Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "notification_templates/3"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be like:
    """
      {
          "name": "New fax notification",
          "type": "fax",
          "id": 3,
          "brand": "~"
      }
    """

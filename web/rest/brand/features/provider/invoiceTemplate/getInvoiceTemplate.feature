Feature: Retrieve invoice templates
  In order to manage invoice templates
  As an super admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the invoice templates json list
    Given I add Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "invoice_templates"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be equal to:
    """
      [
          {
              "name": "Default",
              "id": 1
          }
      ]
    """

  Scenario: Retrieve certain invoice templates json
    Given I add Authorization header
    When I add "Accept" header equal to "application/json"
    And I send a "GET" request to "invoice_templates/1"
    Then the response status code should be 200
    And the response should be in JSON
    And the header "Content-Type" should be equal to "application/json; charset=utf-8"
    And the JSON should be like:
    """
      {
          "name": "Default",
          "description": "Something",
          "template": "Template",
          "templateHeader": "Template header",
          "templateFooter": "Template footer",
          "id": 1,
          "brand": "~"
      }
    """

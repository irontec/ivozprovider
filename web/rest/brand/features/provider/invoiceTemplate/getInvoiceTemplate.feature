Feature: Retrieve invoice templates
  In order to manage invoice templates
  As a brand admin
  I need to be able to retrieve them through the API.

  @createSchema
  Scenario: Retrieve the invoice templates json list
    Given I add Brand Authorization header
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
              "description": "Something",
              "id": 1,
              "global": false
          },
          {
              "name": "Generic",
              "description": "Generic invoice template",
              "id": 2,
              "global": true
          }
      ]
    """

  Scenario: Retrieve certain invoice templates json
    Given I add Brand Authorization header
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
          "global": false
      }
    """
